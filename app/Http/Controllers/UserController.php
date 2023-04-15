<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get all users",
     *     operationId="getUsers",
     *     tags={"User Management"},
     *     @OA\Response(
     *         response="200",
     *         description="List of users"
     *     )
     * )
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Create a new user",
     *     operationId="createUser",
     *     tags={"User Management"},
     *     @OA\RequestBody(
     *         required=true,
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"name", "email", "password"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="John Doe"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="johndoe@example.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     example="secret"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string",
     *                     example="12345678"
     *                 ),
     *                 @OA\Property(
     *                     property="user_level",
     *                     type="string",
     *                     example="warga_desa"
     *                 ),
     *             ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="User created",
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation error",
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'string|regex:/^([0-9\s\-\+\(\)]*)$/|max:20|nullable',
            'user_level' => 'string|nullable'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['photo'] = 'https://www.gravatar.com/avatar/' . md5(strtolower($validatedData['email']));
        $user = User::create($validatedData);

        return response()->json(['data' => $user], 201);
    }

    /**
     * @OA\Get(
     *   path="/api/users/{id}",
     *   operationId="showUser",
     *   tags={"User Management"},
     *   summary="Retrieve a single user by ID",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="User record retrieved successfully"
     *   ),
     *   @OA\Response(
     *     response="404",
     *     description="User record not found"
     *   )
     * )
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['data' => $user]);
    }


    /**
     * @OA\Get(
     *   path="/api/user-by-email/{email}",
     *   operationId="showUserByEmail",
     *   tags={"User Management"},
     *   summary="Retrieve a single user by email",
     *   @OA\Parameter(
     *     name="email",
     *     in="path",
     *     required=true
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="User record retrieved successfully"
     *   ),
     *   @OA\Response(
     *     response="404",
     *     description="User record not found"
     *   )
     * )
     */
    public function userByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return response()->json(['data' => $user]);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     tags={"User Management"},
     *     operationId="updateUser",
     *     summary="Update a user record",
     *     description="Update a specific user record.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the user to update.",
     *      ),
     *     @OA\RequestBody(
     *         required=true,
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"name", "email", "password"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="John Doe"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="johndoe@example.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     example="secret"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string",
     *                     example="12345678"
     *                 ),
     *                 @OA\Property(
     *                     property="user_level",
     *                     type="string",
     *                     example="warga_desa"
     *                 ),
     *             ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="User record not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|unique:users,email,' . $user->id . '|max:255',
            'password' => 'sometimes|required|string|min:8|max:255',
            'phone' => 'sometimes|string|regex:/^([0-9\s\-\+\(\)]*)$/|max:20|nullable',
            'user_level' => 'sometimes|string|nullable'
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return response()->json(['data' => $user], 200);
    }

    /**
     * Delete a user by ID
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    /**
     * Show reset password page
     *
     * @param $token
     * @return
     */
    public function resetPassword($token)
    {
        $user = User::where('email_verification_token', base64_decode($token))->first();
        $passwordLength = 10;
        $newPassword = '';
        if ($user) {
            $newPassword = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($passwordLength/strlen($x)) )),1, $passwordLength);
            $user->email_verification_token = null;
            $user->password = Hash::make($newPassword);
            $user->update();
        }
        return view('reset-password', ['user' => $user, 'newPassword' => $newPassword]);
    }

    /**
     * @OA\Post(
     *     path="/api/user/password",
     *     tags={"User Management"},
     *     summary="Change user password",
     *     operationId="changePassword",
     *     description="Changes the password of the authenticated user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"current_password", "new_password", "new_password_confirmation"},
     *             @OA\Property(property="id", type="integer", description="The user's ID"),
     *             @OA\Property(property="current_password", type="string", format="password", description="The user's current password"),
     *             @OA\Property(property="new_password", type="string", format="password", description="The user's new password"),
     *             @OA\Property(property="new_password_confirmation", type="string", format="password", description="Confirmation of the user's new password"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Password changed successfully",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized - invalid current password",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($validatedData['id']);

        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return response()->json(['error' => 'Invalid current password'], 401);
        }

        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return response()->json(['success' => 'Password changed successfully'], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}/disable",
     *     tags={"User Management"},
     *     summary="Disable a user",
     *     operationId="disableUser",
     *     description="Disable a user by setting the active flag to false.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the user to disable.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User disabled successfully.",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="User disabled."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found.",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="error",
     *                 type="string",
     *                 example="User not found."
     *             )
     *         )
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function disable($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $user->active = false;
        $user->save();

        return response()->json(['message' => 'User disabled.'], 200);
    }
}
