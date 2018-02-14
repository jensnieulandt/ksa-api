<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function getGroups()
    {
        $groups = Group::all();
        return response()->json(['groups' => $groups], 200);
    }

    public function getGroup($id)
    {
        $group = Group::find($id);
        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }
        return response()->json(['group' => $group], 200);
    }

    public function postGroup(Request $request)
    {
        // validating the request
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $group = new Group([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        $group->save();
        return response()->json(['group' => $group], 201);
    }

    public function putGroup(Request $request, $id)
    {
        // validating the request
//        $this->validate($request, [
//            'title' => 'required',
//            'description' => 'required',
//        ]);

        $group = Group::find($id);
        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }
        $group->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        return response()->json(['group' => $group], 200);
    }

    public function deleteGroup($id)
    {
        $group = Group::find($id);
        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }
        $group->delete();
        return response()->json(['message' => 'Successfully deleted group.'], 200);
    }

    public function publishGroup($id)
    {
        $group = Group::find($id);
        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }
        $group->update(['published' => true]);
        return response()->json(['group' => $group], 200);
    }

    public function unpublishGroup($id)
    {
        $group = Group::find($id);
        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }
        $group->update(['published' => false]);
        return response()->json(['group' => $group], 200);
    }
}
