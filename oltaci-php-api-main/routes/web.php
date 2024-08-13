<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserTypeEnum;
use Illuminate\Support\Facades\Redirect;


Route::get('/', function () {
    return response()->json([
        'appName' => env('APP_NAME'),
        'environment' => env('APP_ENV'),
        'date' => date('Y-m-d - H:i:s'),
        'timezone' => date_default_timezone_get()
    ]);
});

Route::get('/map', [WeatherController::class, 'showMap']);


Route::get('/auth/google/redirect', function (Request $request) {
    return Socialite::driver("google")->redirect();
});

Route::get('/auth/google/callback', function (Request $request) {
    $googleUser = Socialite::driver("google")->stateless()->user();
    $user = User::updateOrCreate(
        ['google_id' => $googleUser->id],
        [
            'name' => explode(" ", $googleUser->name)[0],
            'lastname' => explode(" ", $googleUser->name)[1],
            'username' => $googleUser->email,
            'email' => $googleUser->email,
            'password' => Str::password(12),
            'type' => UserTypeEnum::MEMBER
        ]
    );

    $token = $user->createToken('auth_token')->plainTextToken;
    return redirect(env('FRONTEND_URL') . "?token={$token}");
});

Route::get('/auth/facebook/redirect', function (Request $request) {
    return Socialite::driver("facebook")->redirect();
});

Route::get('/auth/facebook/callback', function (Request $request) {
    $facebookUser = Socialite::driver("facebook")->stateless()->user();
    $user = User::updateOrCreate(
        ['google_id' => $facebookUser->id],
        [
            'name' => explode(" ", $facebookUser->name)[0],
            'lastname' => explode(" ", $facebookUser->name)[1],
            'username' => $facebookUser->email,
            'email' => $facebookUser->email,
            'password' => Str::password(12),
            'type' => UserTypeEnum::MEMBER
        ]
    );
    $token = $user->createToken('auth_token')->plainTextToken;
    $response = redirect(env('FRONTEND_URL'));
    $response->header('token', $token);

    return $response;
});

