<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BoatOwnerRequest;
use App\Http\Resources\BoatOwnerResource;
use App\Models\BoatOwner;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class BoatOwnerController extends Controller
{
     /** Get BoatOwner list */
     public function index(): AnonymousResourceCollection
     {
         return BoatOwnerResource::collection(BoatOwner::sort()->filter()->paginate(Request::get('per_page')));
     }
 
     /** Get BoatOwner list admin */
     public function allBoatOwners(): AnonymousResourceCollection
     {
         return BoatOwnerResource::collection(BoatOwner::all());
     }
     /**
      * Store BoatOwner.
      */
     public function store(BoatOwnerRequest $request): BoatOwnerResource
     {
         return new BoatOwnerResource(BoatOwner::create($request->validated()));
     }
 
     /**
      * Display a specified BoatOwner.
      */
     public function show(BoatOwner $BoatOwner)
     {
         return BoatOwnerResource::make($BoatOwner);
     }
 
 
     /**
      * Update BoatOwner.
      */
     public function update(BoatOwnerRequest $request, BoatOwner $BoatOwner): BoatOwnerResource
     {
         return new BoatOwnerResource($BoatOwner->update($request->validated()));
     }
 
     /**
      * Remove BoatOwner.
      */
     public function destroy(BoatOwner $BoatOwner): Response
     {
         $BoatOwner->delete();
 
         return response()->noContent();
     }
}
