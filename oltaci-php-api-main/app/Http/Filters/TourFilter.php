<?php

namespace App\Http\Filters;

use App\Enums\TripStatusEnum;
use App\Http\Requests\TourFilterRequest;
use App\Models\Boat;
use App\Models\Region;
use App\Models\Captain;
use App\Models\Tour;
use App\Models\Trip;
use DateTime;
use Log;

class TourFilter extends Filter
{
    public function index(TourFilterRequest $request)
    {
        log::info($request->all());
        $query = Tour::query();
        if ($request->filled('boat')) {
            $query->where('boat_id', $request->input('boat'));
        }
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }
        if ($request->filled('region')) {
            $query->where('region_id', $request->input('region'));
        }
        if ($request->filled('captain_id')) {
            $query->where('captain_id', $request->input('captain_id'));
        }
        $tours = $query->with('boat', 'region', 'captain')->get();
        $data = [];
        foreach ($tours as $tour) {
            if ($this->datesRangeCheck($request, $tour)) {
                $data[] = $tour;
            }
        }
        return response()->json($data);
    }

    public function datesRangeCheck(TourFilterRequest $request, Tour $tour): bool
    {
        if ($request->filled('date')) {
            $boat = Boat::find($tour->boat_id);
            $trips = Trip::where('boat_id', $boat->id)->get();
            foreach ($trips as $trip) {

                // if($trip->status == 'ONGOING'){
                //     return false;
                // }
                if(/*$trip->status == 'SCHEDULED' && */$this->DateInBetween($trip->start, $trip->end, $request->input('date'))){
                    return false;
                }
            }
        }
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $boat = Boat::find($tour->boat_id);
            $trips = Trip::where('boat_id', $boat->id)->get();
            foreach ($trips as $trip) {
                if ($this->SingleDateBetweenDates($request->input('date_from'), $request->input('date_to'), $trip->start) || $this->SingleDateBetweenDates($request->input('date_from'), $request->input('date_to'), $trip->end)) {
                    return false;
                }
            }
        }
        if ($request->filled('price_from') && $request->filled('price_to')) {
            if ($tour->price) {
                if ($request->filled('price_from') && $request->filled('price_to')) {
                    if (!(($tour->price >= $request->input('price_from')) && ($tour->price <= $request->input('price_to')))) {
                        return false;
                    }
                }
            }
        }
        if ($request->filled('duration_from') && $request->filled('duration_to')) {
            if ($tour->price) {
                if ($request->filled('duration_from') && $request->filled('duration_to')) {
                    if (!(($tour->duration >= $request->input('duration_from')) && ($tour->duration <= $request->input('duration_to')))) {
                        return false;
                    }
                }
            }
        }
        if ($request->filled('location')) {
            if ($tour->region_id) {
                if (!(Region::find($tour->region_id)->location == $request->input('location'))) {
                    return false;
                }
            }
        }
        return true;
    }
    public function SingleDateBetweenDates($d1, $d2, $d): bool
    {
        $dTimestamp = intval(strtotime((new Datetime($d))->format('Y-m-d H:i:s')));
        $d1Timestamp = intval(strtotime((new Datetime($d1))->format('Y-m-d H:i:s')));
        $d2Timestamp = intval(strtotime((new Datetime($d2))->format('Y-m-d H:i:s')));
        if (($dTimestamp >= $d1Timestamp) && ($dTimestamp <= $d2Timestamp)) {
            return true;
        }
        return false;
    }

    public function DateInBetween($d1, $d2, $d): bool
    {
        $dTimestamp = intval(strtotime((new Datetime($d))->format('Y-m-d')));
        $d1Timestamp = intval(strtotime((new Datetime($d1))->format('Y-m-d')));
        $d2Timestamp = intval(strtotime((new Datetime($d2))->format('Y-m-d')));
        if (($dTimestamp >= $d1Timestamp) && ($dTimestamp <= $d2Timestamp)) {
            return true;
        }
        return false;
    }
}
