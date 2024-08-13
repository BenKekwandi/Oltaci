<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoatRequest;
use App\Http\Resources\BoatResource;
use App\Models\Boat;
use App\Enums\BoatTypeEnum;
use App\Models\BoatPicture;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;
use Log;



class BoatController extends Controller
{
    /** Get Boat list */
    public function index(): AnonymousResourceCollection
    {
        return BoatResource::collection(Boat::with('pictures', 'equipments')->sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Boat list admin */
    public function allBoats(): AnonymousResourceCollection
    {
        return BoatResource::collection(Boat::with('pictures', 'equipments')->get());
    }


    /**
     * Store Boat.
     */
    public function store(BoatRequest $request): BoatResource
    {
        Log::info($request->all());
        Log::info('Request files: ', $request->allFiles());
        $path = null;

        // Handle single picture upload
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $pictureName = time() . '_' . uniqid() . '.' . $picture->getClientOriginalExtension();
            $path = $picture->storeAs('boats', $pictureName, 'public');
        }

        // Handle multiple pictures upload
        $picturesPaths = [];
        if ($request->hasFile('pictures')) {
            $pictures = $request->file('pictures');
            foreach ($pictures as $key => $picture) {
                $pictureName = time() . '_picture_' . $key . '.' . $picture->getClientOriginalExtension();
                $picturePath = $picture->storeAs('boatPictures', $pictureName, 'public');
                $picturesPaths[] = $picturePath;
            }
        }

        $validatedData = $request->validated();
        $validatedData['picture'] = $path;

        // Create the boat record
        $boat = Boat::create($validatedData);

        // Create records for boat pictures
        if ($request->hasFile('pictures')) {
            foreach ($picturesPaths as $picturePath) {
                BoatPicture::create([
                    "picture" => $picturePath,
                    "boat_id" => $boat->id
                ]);
            }
        }

        return new BoatResource($boat);


    }

    /**
     * Display a specified Boat.
     */
    public function show(Boat $boat)
    {
        $boat->load('pictures');
        return BoatResource::make($boat);
    }


    /**
     * Update Boat.
     */
    public function update(BoatRequest $request, Boat $boat): BoatResource
    {
        $path = null;
        if ($request->picture) {
            $parsedUrl = parse_url($request->picture);
            $paths = $parsedUrl['path'];
            $path = substr($paths, strpos($paths, '/storage/') + strlen('/storage/'));
        }

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $pictureName = time() . '_' . uniqid() . '.' . $picture->getClientOriginalExtension();
            $path = $picture->storeAs('boats', $pictureName, 'public');
        }

        // Handle multiple pictures upload
        $picturesPaths = [];
        if ($request->hasFile('pictures')) {
            $pictures = $request->file('pictures');
            foreach ($pictures as $key => $picture) {
                $pictureName = time() . '_picture_' . $key . '.' . $picture->getClientOriginalExtension();
                $picturePath = $picture->storeAs('boatPictures', $pictureName, 'public');
                $picturesPaths[] = $picturePath;
            }
        }

        if (!is_string($request->file('picture')) && $path && $boat->picture != $path) {
            Storage::disk('public')->delete($boat->picture);
            $boat->update(['picture' => $path]);
        }

        $boat->update($request->validated());

        if ($request->hasFile('pictures')) {
            foreach ($picturesPaths as $picturePath) {
                BoatPicture::create([
                    "picture" => $picturePath,
                    "boat_id" => $boat->id
                ]);
            }
        }
        return new BoatResource($boat);
    }

    /**
     * Remove Boat.
     */
    public function destroy(Boat $boat): Response
    {
        $boat->delete();

        return response()->noContent();
    }
}
