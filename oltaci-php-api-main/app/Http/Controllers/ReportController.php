<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;
use Log;
use Carbon\Carbon;
use App\Models\Boat;
use App\Models\Captain;
use App\Models\Trip;
use App\Models\Reservation;
use App\Models\User;
class ReportController extends Controller
{
    public function index(): JsonResponse
    {
        $transactions = Transaction::where(['type'=>'INCOME'])->get();

        $daily = [
            "TRY" => 0,
            "USD" => 0,
            "GBP" => 0,
            "EUR" => 0
        ];

        $weekly = [
            "TRY" => 0,
            "USD" => 0,
            "GBP" => 0,
            "EUR" => 0
        ];

        $monthly = [
            "TRY" => 0,
            "USD" => 0,
            "GBP" => 0,
            "EUR" => 0
        ];

        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek()->toDateString();

        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

        foreach ($transactions as $transaction) {

            if (Carbon::parse($transaction->created_at)->toDateString() == Carbon::now()->toDateString()) {
                $this->addToCurrency($daily, $transaction->currency, $transaction->amount);
            }

            if (Carbon::parse($transaction->created_at)->between($startOfWeek, $endOfWeek)) {
                $this->addToCurrency($weekly, $transaction->currency, $transaction->amount);
            }

            if (Carbon::parse($transaction->created_at)->between($startOfMonth, $endOfMonth)) {
                $this->addToCurrency($monthly, $transaction->currency, $transaction->amount);
            }
        }

        return response()->json([
            "data" => [
                "daily_totals" => $daily,
                "weekly_totals" => $weekly,
                "monthly_totals" => $monthly
            ],
            "message" => "success",
        ], 200);
    }

    private function addToCurrency(&$array, $currency, $amount)
    {
        switch ($currency) {
            case 'TRY':
                $array['TRY'] += $amount;
                break;
            case 'USD':
                $array['USD'] += $amount;
                break;
            case 'GBP':
                $array['GBP'] += $amount;
                break;
            case 'EUR':
                $array['EUR'] += $amount;
                break;
            default:
                break;
        }
    }

    public function generalReport(): JsonResponse
    {
        $boats = Boat::count();
        $trips = Trip::count();
        $captains = Captain::count();
        $members = User::where(['type'=>'MEMBER'])->count();
        $ongoingTrips = Trip::where('status', 'ONGOING')->count();
        $reservations = Reservation::count();
        $dailyReservations = Reservation::whereDate('created_at', now()->toDateString())->where(['has_been_paid'=>TRUE])->count();
    
        return response()->json([
            "data" => [
                "boats" => $boats,
                "trips" => $trips,
                "members" => $members,
                "captains" =>$captains,
                "ongoing_trips" => $ongoingTrips,
                "reservations" => $reservations,
                "daily_reservations" => $dailyReservations,
            ],
            "message" => "success",
        ], 200);
    }
}
