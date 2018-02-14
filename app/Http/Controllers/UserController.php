<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    private function camelCase($str, $noStrip)
    {
        // converting $str to camelCase
        // non-alpha and non-numeric characters become spaces
        $str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $str);
        $str = trim($str);
        // uppercase the first character of each word
        $str = ucwords($str);
        $str = str_replace(" ", "", $str);
        return $str = lcfirst($str); // comment this for Pascal
    }

    /**
     * @param $file
     * @param $user
     * @return mixed
     */
    private function changeProfilePicture($file, $name, $noStrip)
    {
        // saving profile picture if present
        // checking if file is valid
        if ($file->isValid()) {
            // requesting the image
            $image = $file;
            // caching the extension
            $extension = $image->getClientOriginalExtension();

            $fileName = $this->camelCase($name, $noStrip);

            // moving the image and saving the generated file name + extension
            $fileName = $fileName . '.' . $extension;
            $destinationPath = base_path() . '/public/img/users/';
            $image->move($destinationPath, $fileName);
            return ['profile_picture' => 'img/users/' . $fileName];
        } else {
            return false;
        }
    }

    public function createUser(Request $request)
    {
        // validating the request
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'group_id' => 'required',
            'duties' => 'required'
        ]);

        // creating a new user with given info
        $user = new User([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('email')),
            'group_id' => $request->input('group_id'),
            'mobile_phone' => $request->input('mobile_phone'),
        ]);
        $user->save();

        // converting duties input to array
        $duties = json_decode($request->input('duties'), true);
        // attaching appropriate duties to the user
        $user->duties()->attach($duties); // accepts number || array

        // calling change profile picture if file is present
        $error = '';
        if ($request->hasFile('profile_picture')) {
            $name = trim($user->first_name) . ' ' . trim($user->last_name);
            if (!$profilePicColArray = $this->changeProfilePicture($request->file('profile_picture'), $name, [])) {
                $error = ' Profile picture is not valid';
            } else {
                $user->update($profilePicColArray);
            };
        }

        // returning a success-message
        return response()->json([
            'message' => 'Successfully created user.' . $error
        ], 201);
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');

        // caching the user from database
        $user = User::where('email', '=', $credentials['email'])->first();
        // getting the role id
        $role = $user->role[0]->id;

        // creating the custom claims for JWTAuth to store in the token
        $customClaims = ['usr' => $user->id, 'rol' => $role, 'grp' => $user->group_id];

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials, $customClaims)) {
                // invalid credentials given
                return response()->json([
                    'error' => 'Invalid Credentials!'
                ], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                'error' => 'Could not create token!'
            ], 500);
        }
        // all good so return the token
        return response()->json([
            'token' => $token
        ], 200);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        $user->delete();
        return response()->json([
            'message' => 'Successfully deleted user!'
        ], 200);
    }

    public function putUser(Request $request, $id)
    {
        // validating the request
        $this->validate($request, [
            'email' => 'email|unique:users'
        ]);

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        $path = $user->profile_picture;
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'mobile_phone' => $request->input('mobile_phone'),
        ]);

        $error = '';
        if ($request->hasFile('profile_picture')) {
            $name = trim($user->first_name) . ' ' . trim($user->last_name);
            if (!$profilePicColArray = $this->changeProfilePicture($request->file('profile_picture'), $name, [])) {
                $error = ' Profile picture is not valid';
            } else {
                File::delete($path);
                $user->update($profilePicColArray);
            };
        }

        return response()->json(['message' => 'Successfully updated user.' . $error, 'user' => $user], 200);
    }

    public function resetPassword($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $user->update([
            'password' => bcrypt($user->email),
        ]);
        return response()->json([
            'message' => 'Successfully reset password.!'
        ], 200);
    }

    public function editPassword(Request $request, $id)
    {
        // validating the request
        $this->validate($request, [
            'password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
// TO DO: authenticate user
        if ($request->input('new_password') !== $request->input('confirm_password')){
            return response()->json(['message' => 'The confirmed password does not match the new one.'], 418);
        }
            $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $user->update([
            'password' => bcrypt($request->input('new_password')),
        ]);
        return response()->json([
            'message' => 'Successfully changed password.!'
        ], 200);
    }

    /*
     * get all users
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'users' => $users
        ], 200);
    }

    /*
     * get all roles from a user
     */
    public function getRole($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        $role = $user->role[0];
        return response()->json([
            'role' => $role
        ], 200);
    }

    /*
     * get all users from a role
     */
    public function getRoleUsers($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found.'], 404);
        }
        $users = $role->users;
        return response()->json([
            'users' => $users
        ], 200);
    }

}
