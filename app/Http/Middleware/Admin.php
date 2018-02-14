<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // getting the id of admin and superadmin in roles_tbl
        $adminId = Role::where('title', '=', 'admin')->first()->id;
        $superAdminId = Role::where('title', '=', 'superadmin')->first()->id;

        // extracting the role of the authenticated user from the token
        $payload = JWTAuth::parseToken()->getPayload();
        $payloadRole = $payload['rol'];

        // when the user is an admin or superadmin, he may proceed
        if (!($payloadRole === $adminId || $payloadRole === $superAdminId)) {
            return response('You are not authorised. Contact an admin.', 401);
        }
        return $next($request);

    }
}
