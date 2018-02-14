<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
 * not authenticated users
 */
// login user
Route::post('/user/authenticate', [
    'uses' => 'UserController@authenticate'
]);

// get events
Route::get('/events', [
    'uses' => 'EventController@getEvents'
]);

// get events by group
Route::get('/group-events/{id}', [
    'uses' => 'EventController@getGroupEvents'
]);

// get groups
Route::get('/groups', [
    'uses' => 'GroupController@getGroups'
]);

// get images by event id
Route::get('/images/{id}', [
    'uses' => 'EventController@getImages'
]);

Route::group(['middleware' => ['auth.jwt']], function () {
    /*
     * Logged in users
     */
    // update user
    Route::put('/user/{id}', [
        'uses' => 'UserController@putUser'
    ]);

    // update password
    Route::post('/password/{id}', [
        'uses' => 'UserController@editPassword'
    ]);

    // get event
    Route::get('/event/{id}', [
        'uses' => 'EventController@getEvent'
    ]);

    // create event
    Route::post('/event', [
        'uses' => 'EventController@postEvent'
    ]);

    // update event
    Route::put('/event/{id}', [
        'uses' => 'EventController@putEvent'
    ]);

    // delete event
    Route::delete('/event/{id}', [
        'uses' => 'EventController@deleteEvent'
    ]);

    Route::group(['middleware' => ['admin']], function () {
        /*
         * Admin
         */
        // create new user
        Route::post('/user', [
            'uses' => 'UserController@createUser'
        ]);

        // delete user
        Route::delete('/user/{id}', [
            'uses' => 'UserController@deleteUser'
        ]);

        // reset password
        Route::delete('/password/{id}', [
            'uses' => 'UserController@resetPassword'
        ]);
    });

    Route::group(['middleware' => ['superadmin']], function () {
        /*
        * Superadmin
        */
        // get role of user
        Route::get('/user-role/{id}', [
            'uses' => 'UserController@getRole'
        ]);

        // get users of role
        Route::get('/role-users/{id}', [
            'uses' => 'UserController@getRoleUsers'
        ]);
    });

});
