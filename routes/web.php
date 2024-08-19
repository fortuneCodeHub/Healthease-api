<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Set protection for api
Route::get('/setup', function () {
    $credentials = [
        'email' => 'admin@admin.com',
        'password' => 'password',
    ];

    // Check if the the data in $credentials exist, if not create the user for these details
    if (!Auth::attempt($credentials)) {
        $user = new \App\Models\User();

        $user->username = "Admin";
        $user->other = "Null";
        $user->firstname = "Null";
        $user->type = "admin";
        $user->address = "Null";
        $user->number = "Null";
        $user->language = "Null";
        $user->email = $credentials["email"];
        $user->password = $credentials["password"];

        // Create the user
        $user->save();

        // Sign the user in
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // This is the token for the admin
            $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']); // the admins have access to perform CRUD

            // This is the token for the user
            $updateToken = $user->createToken('update-token', ['create', 'update']); // the users have access to perform CRU

            // This is the basic token
            $basicToken = $user->createToken('basic-token'); // this gives only read access

            return [
                "admin" => $adminToken->plainTextToken,
                "update" => $updateToken->plainTextToken,
                "basic" => $basicToken->plainTextToken,
            ];
        }
    }
});
