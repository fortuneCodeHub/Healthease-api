<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Filters\V1\UserFilter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\UserCollection;
use App\Http\Requests\V1\LoginUserRequest;
use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Requests\V1\UpdateUserRequest;

class UserController extends Controller
{
    //
    /**
     * Display all the user data in the database
     */
    public function index(Request $request)
    {
        try {
            // Filter data based on url queries
            $filter = new UserFilter();
            $queryItems = $filter->transform($request); //[["column", "operator", "value"]]

            // return new UserCollection(User::all());
            if (count($queryItems) == 0) {
                // Response to front-end
                return response()->json([
                    'status' => true,
                    'data' => new UserCollection(User::paginate())
                ], 200);

            } else {
                $users = User::where($queryItems)->paginate();

                // Response to front-end
                return response()->json([
                    'status' => true,
                    'data' => new UserCollection($users->appends($request->query()))
                ], 200);
            }
        } catch (Exception $e) {
            // Response to front-end
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show one users data
     */
    public function show(User $user)
    {
        // Response to front-end
        return response()->json([
            'status' => true,
            'data' => new UserResource($user)
        ], 200);
    }

    /**
     * Store new user details
     */
    public function store(StoreUserRequest $request)
    {
        try {

            $request->password = Hash::make($request->password);

            // Response to front-end
            return response()->json([
                'status' => true,
                'data' => new UserResource(User::create($request->all())),
                'message' => "User created successfully"
            ], 200);

        } catch (Exception $e) {
            // Response to front-end
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update new user details
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {

            $user->update($request->all());

            // Response to frontend
            return response()->json([
                'status' => true,
                'data' => new UserResource($user),
                'message' => "User updated successfully"
            ], 200);

        } catch (Exception $e) {
            // Response to front-end
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Login user
     */
    public function login(LoginUserRequest $request)
    {
        try {
            // Authenticate Log In Credentials
            $user = User::where('email', '=', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    // Response to frontend
                    return response()->json([
                        'status' => true,
                        'data' => $user,
                        'message' => "Login successful"
                    ], 200);
                } else {
                    // Response to frontend
                    return response()->json([
                        'status' => false,
                        'message' => "The password does not exist"
                    ], 401);
                }
            } else {
                // Response to front-end
                return response()->json([
                    'status' => false,
                    'message' => "The email does not exist"
                ], 401);
            }

        } catch (Exception $e) {
            // Response to front-end
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
