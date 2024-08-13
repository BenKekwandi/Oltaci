<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Enums\UserTypeEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserRegistrationNotification;

class AuthController extends Controller
{

    /**
     * @unauthenticated
     * Login user and create token
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function adminLogin(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();

            if ($user) {

                if ($user->is_active === false) {
                    return response()->json(['error' => 'User account inactive'], 403);
                }

                if ($user->type != 'ADMIN') {
                    return response()->json(['error' => 'Access Denied'], 403);
                }

                $token = $user->createToken('token')->plainTextToken;

            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }

            return response()->json(['user' => UserResource::make($user), 'token' => $token]);

        } else {
            return response()->json(['error' => 'Username or password incorrect'], 401);
        }

    }

    public function userLogin(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();

            if ($user) {

                if ($user->is_active === false) {
                    return response()->json(['error' => 'User account inactive'], 403);
                }

                $token = $user->createToken('token')->plainTextToken;

            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }

            return response()->json(['user' => UserResource::make($user), 'token' => $token]);

        } else {
            return response()->json(['error' => 'Username or password incorrect'], 401);
        }

    }

    /**
     * Get the authenticated user
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        return response()->json(UserResource::make($user));
    }

    /**
     * Update self password.
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        $user->update($request->validated());
        return response()->json(new UserResource($user));
    }


    /**
     * Log the user out (Invalidate the token)
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        
        if ($user->type != 'ADMIN') {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
        } else
            $user->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function memberRegistration(RegisterRequest $request): UserResource
    {
        $validatedData = $request->validated();
        $validatedData['type'] = UserTypeEnum::MEMBER;
        $validatedData['is_active'] = true;
        $user = User::create($validatedData);
        $token = $user->createToken('token')->plainTextToken;
        // $user->notify(new UserRegistrationNotification($user));
        return (new UserResource($user))->additional(['token' => $token]);
    }

}   