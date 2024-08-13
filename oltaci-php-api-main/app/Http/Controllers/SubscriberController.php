<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubscriberRequest;
use App\Http\Resources\SubscriberResource;
use App\Models\Subscriber;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Notifications\SubscriberWelcomeNotification;


class SubscriberController extends Controller
{
     /** Get Subscriber list */
     public function index(): AnonymousResourceCollection
     {
         return SubscriberResource::collection(Subscriber::sort()->filter()->paginate(Request::get('per_page')));
     }
 
     /** Get Subscriber list admin */
     public function allSubscribers(): AnonymousResourceCollection
     {
         return SubscriberResource::collection(Subscriber::all());
     }
     /**
      * Store Subscriber.
      */
     public function store(SubscriberRequest $request): SubscriberResource
     {
        $subscriber = Subscriber::create($request->validated());
        $subscriber->notify(new SubscriberWelcomeNotification($subscriber));
        return new SubscriberResource($subscriber);
        // return new SubscriberResource(Subscriber::create($request->validated()));
     }
 
     /**
      * Display a specified Subscriber.
      */
     public function show(Subscriber $Subscriber)
     {
         return SubscriberResource::make($Subscriber);
     }
 
 
     /**
      * Update Subscriber.
      */
     public function update(SubscriberRequest $request, Subscriber $Subscriber): SubscriberResource
     {
         return new SubscriberResource($Subscriber->update($request->validated()));
     }
 
     /**
      * Remove Subscriber.
      */
     public function destroy(Subscriber $Subscriber): Response
     {
         $Subscriber->delete();
 
         return response()->noContent();
     }
}
