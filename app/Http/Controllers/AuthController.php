<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/login",
     *      operationId="login",
     *      tags={"Authentication"},
     *      summary="Login a user and generate an access token",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"email", "password"},
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="dummy@example.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     example="secret"
     *                 ),
     *             ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Login successful",
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Invalid credentials",
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Validation error",
     *      )
     * )
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'message' => 'Validation error.'], 401);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            return response()->json(['user' => $user, 'access_token' => $token, 'message' => 'Welcome, ' . $request->get('email')], 200);
        } else {
            return response()->json(['error' => 'Unauthorized', 'message' => 'Alamat email atau kata sandi yang Anda masukkan salah. Silakan coba lagi.'], 401);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/logout",
     *      operationId="logout",
     *      tags={"Authentication"},
     *      summary="Logout the authenticated user and revoke their access token",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response="200",
     *          description="Logout successful",
     *      )
     * )
     */
    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->token()->revoke();
        }
        return response()->json(['message' => 'Logout successful'], 200);
    }

    /**
     * Verify the email address of a user
     *
     * @OA\Get(
     *      path="/api/verify-email/{token}",
     *      summary="Verify user email",
     *      operationId="verifyEmail",
     *      description="Verify the email address of a user using the provided email verification token",
     *      tags={"Authentication"},
     *      @OA\Parameter(
     *          name="token",
     *          in="path",
     *          description="The email verification token",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Email verified successfully",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Email verified"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Invalid token",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="error",
     *                  type="string",
     *                  example="Invalid token"
     *              )
     *          )
     *      )
     * )
     */
    public function verifyEmail($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->save();

        return response()->json(['message' => 'Email verified'], 200);
    }

    /**
     * Sends an email verification link to the user.
     *
     * @OA\Post(
     *      path="/api/send-email-verification-link",
     *      operationId="sendEmailVerificationLink",
     *      tags={"Authentication"},
     *      summary="Sends an email verification link to the user.",
     *      description="Sends an email verification link to the user. The link contains a unique token that the user can use to verify their email address.",
     *      @OA\RequestBody(
     *          required=true,
     *          description="The email address of the user.",
     *          @OA\JsonContent(
     *              required={"email"},
     *              @OA\Property(property="email", type="string", example="user@example.com"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="The email verification link has been sent successfully.",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Email verification link sent"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="The request is invalid.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="object", example={"email": {"The email field is required."}}),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="The user does not exist.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="User not found"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="An error occurred while sending the email verification link.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="An error occurred while sending the email verification link."),
     *          ),
     *      ),
     * )
     */
    public function sendEmailVerificationLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($user->email_verified_at) {
            return response()->json(['message' => 'Email already verified'], 200);
        }

        $token = Hash::make(now());
        $user->email_verification_token = $token;
        $user->save();

        Mail::to($user->email)->send(new PasswordReset($user, url('/reset-password', base64_encode($token))));

        return response()->json(['message' => 'Email verification link sent'], 200);
    }
}
