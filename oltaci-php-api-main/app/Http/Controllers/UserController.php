<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
// use App\Http\Requests\SendPasswordMailRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Enums\UserTypeEnum;
// use App\Models\PasswordResetToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;


// use App\Notifications\PasswordMailNotification;
// use Notification;

class UserController extends Controller
{
    /** Get user list */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::sort()->filter()->paginate(Request::get("per_page")));
    }

    /** Get user list admin */
    public function allUsers(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    /** Store user */
    public function store(UserRequest $request): UserResource
    {
        $validatedData = $request->validated();
        $userData = array_merge($validatedData, ['type' => UserTypeEnum::MEMBER, 'password' => Hash::make('password')]);
        return new UserResource(User::create($userData));
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): UserResource
    {
        return UserResource::make($user);
    }

    /**
     * Update the user.
     */
    public function update(User $user, UserRequest $request): UserResource
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the user.
     */
    public function destroy(User $user): Response
    {
        $user->delete();
        return response()->noContent();
    }

    /**
     * Get Password Token
     * @param User $user
     * @return JsonResponse
     */
    public function getPasswordToken(User $user): JsonResponse
    {

        $passwordResetToken = PasswordResetToken::find($user->email);

        if ($passwordResetToken) {
            $passwordResetToken->delete();
        }
        $token = Password::createToken($user);

        return response()->json(['token' => $token], 200);
    }


    /**
     *
     * Update Password with Token.
     */
    public function changePassword(User $user, ChangePasswordRequest $request): UserResource
    {
        $request->validated();
        $user->password = bcrypt($request->password);
        $user->save();

        return new UserResource($user);

    }

    /**
     *
     * Send Password Reset Mail 
     */

    // public function sendPasswordMail(User $user, SendPasswordMailRequest $request) : JsonResponse
    // {
    //     $request->validated();
    //     $content = [
    //         'link' => $request->input('link')
    //     ];

    //     $user->notify(new PasswordMailNotification($content));

    //     return response()->json(['message' => 'Password Mail successfully sent'], 200);
    // }


}