<?php

use App\Http\Controllers\BoatController;
use App\Http\Controllers\BoatPictureController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentGateways\IyzipayController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CaptainController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\AdditionalServiceController;
use App\Http\Controllers\ReservationAdditionalServiceController;
use App\Http\Controllers\CatchRecordController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\BoatLogController;
use App\Http\Controllers\BoatMaintenanceController;
use App\Http\Controllers\BoatEquipmentController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\BoatOwnerController;
use App\Http\Controllers\BoatFuelingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubscriberController;

use App\Http\Filters\BoatFilter;
use App\Http\Filters\TourFilter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'date' => date('Y-m-d - H:i:s'),
        'timezone' => date_default_timezone_get(),
    ]);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', ['as' => 'login', 'uses' => AuthController::class . '@userLogin']);
    Route::post('admin/login', ['as' => 'adminLogin', 'uses' => AuthController::class . '@adminLogin']);
    Route::post('member/register', AuthController::class . '@memberRegistration');
});

Route::get('/weather', [WeatherController::class, 'fetchWeather']);
Route::get('additional-services', AdditionalServiceController::class . '@allAdditionalServices');
Route::get('tour', TourController::class . '@index');
Route::get('tours', TourController::class . '@allTours');
Route::get('trip', TripController::class . '@index');
Route::get('tour/{id}', TourController::class . '@tour');
Route::get('boat-pictures/{id}', BoatPictureController::class . '@pictures');
Route::post('tours-filter', TourFilter::class . '@index');
Route::get('region', RegionController::class . '@index');
Route::get('captain', CaptainController::class . '@allCaptains');
Route::get('comment', CommentController::class . '@index');
Route::apiResource('subscriber', SubscriberController::class);

Route::get('posts', PostController::class . '@allPosts');
Route::apiResource('post', PostController::class)->except(['index']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/auth-user', function (Request $request) {

        $user = $request->user();
        $userDetails = [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'lastname' => $user->lastname,
            'username' => $user->username,
            'type' => $user->type,
        ];

        return $userDetails;
    });

    Route::get('me', AuthController::class . '@me');
    Route::patch('me/change_password', AuthController::class . '@changePassword');
    Route::get('logout', AuthController::class . '@logout');

    Route::apiResource('boat', BoatController::class)->except(['update']);
    Route::get('boats', BoatController::class . '@allBoats');
    Route::post('boat/{boat}', BoatController::class . '@update');


    Route::apiResource('region', RegionController::class)->except(['index']);
    Route::get('regions', RegionController::class . '@allRegions');

    Route::apiResource('reservation', ReservationController::class);
    Route::get('reservations', ReservationController::class . '@allReservations');

    Route::apiResource('tour', TourController::class)->except(['index']);

    Route::apiResource('transaction', TransactionController::class);
    Route::get('transactions', TransactionController::class . '@allTransactions');

    Route::apiResource('income', IncomeController::class);
    Route::get('incomes', IncomeController::class . '@allIncomes');

    Route::apiResource('expense', ExpenseController::class);
    Route::get('expenses', ExpenseController::class . '@allExpenses');

    Route::apiResource('invoice', InvoiceController::class)->except(['index']);
    Route::get('invoices', InvoiceController::class . '@allInvoices');

    Route::apiResource('user', UserController::class);
    Route::get('users', UserController::class . '@allUsers');

    Route::apiResource('captain', CaptainController::class)->except(['index', 'update']);
    Route::get('captains', CaptainController::class . '@allCaptains');
    Route::post('captain/{captain}', CaptainController::class . '@update');

    Route::apiResource('boat_picture', BoatPictureController::class);
    Route::get('boat_pictures', BoatPictureController::class . '@allBoats');

    Route::apiResource('additional_service', AdditionalServiceController::class);

    Route::apiResource('reservation_additional_service', ReservationAdditionalServiceController::class);
    Route::get('reservation_additional_services', ReservationAdditionalServiceController::class . '@allReservationAdditionalServices');

    Route::apiResource('trip', TripController::class)->except(['index']);
    Route::get('trips', TripController::class . '@allTrips');


    Route::apiResource('catch_record', CatchRecordController::class);
    Route::get('catch_records', CatchRecordController::class . '@allCatchRecords');

    Route::apiResource('equipment', EquipmentController::class);
    Route::get('equipments', EquipmentController::class . '@allEquipments');

    Route::apiResource('boat_equipment', BoatEquipmentController::class);
    Route::get('boat_equipments', BoatEquipmentController::class . '@allBoatEquipments');

    Route::apiResource('boat_maintenance', BoatMaintenanceController::class);
    Route::get('boat_maintenances', BoatMaintenanceController::class . '@allBoatMaintenances');

    Route::apiResource('boat_fueling', BoatFuelingController::class);
    Route::get('boat_fuelings', BoatFuelingController::class . '@allBoatFuelings');

    Route::apiResource('boat_log', BoatLogController::class);
    Route::get('boat_logs', BoatLogController::class . '@allBoatLogs');

    // Route::apiResource('subscriber', SubscriberController::class);
    Route::get('subscribers', SubscriberController::class . '@allSubscribers');


    Route::prefix('iyzipay')->group(function () {
        Route::post('pay', [IyzipayController::class, 'pay']);
        Route::post('callback', [IyzipayController::class, 'callback']);
        Route::get('check', [IyzipayController::class, 'check']);
    });

    Route::get('/forecast', [WeatherController::class, 'getForecast']);
    // Route::get('/weather', [WeatherController::class, 'fetchWeather']);

    Route::get('/report', ReportController::class . '@index');
    Route::get('/general-report', ReportController::class . '@generalReport');


});


