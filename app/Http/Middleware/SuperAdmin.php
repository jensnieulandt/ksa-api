<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdmin
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
        // getting the id of superadmin in roles_tbl
        $superAdminId = Role::where('title', '=', 'superadmin')->first()->id;

        // extracting the role of the authenticated user from the token
        $payload = JWTAuth::parseToken()->getPayload();
        $payloadRole = $payload['rol'];

        // when the user is an admin or superadmin, he may proceed
        if (!($payloadRole === $superAdminId)) {
            return response('You are not authorised. Contact an admin.', 401);
        }
        return $next($request);
    }
}
