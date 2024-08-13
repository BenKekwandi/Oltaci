<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoatPictureRequest;
use App\Http\Resources\BoatPictureResource;
use App\Models\BoatPicture;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class BoatPictureController extends Controller
{
    /** Get BoatPicture list */
    public function index(): AnonymousResourceCollection
    {
        return BoatPictureResource::collection(BoatPicture::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get BoatPicture list admin */
    public function allBoatPictures(): AnonymousResourceCollection
    {
        return BoatPictureResource::collection(BoatPicture::all());
    }


    public function pictures($id)
    {
        return BoatPictureResource::collection(BoatPicture::where(['boat_id'=>$id])->get());
    }


    /**
     * Store BoatPicture.
     */
    public function store(BoatPictureRequest $request): BoatPictureResource
    {
        $path = null;
        if ($request->image) {
            $parsedUrl = parse_url($request->image);
            $paths = $parsedUrl['path'];
            $path = substr($paths, strpos($paths, '/storage/') + strlen('/storage/'));
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('boatPictures', $imageName, 'public');
        }
        $validatedData = $request->validated();
        $validatedData['picture'] = $path;
        $boatPicture = BoatPicture::create($validatedData);
        return new BoatPictureResource($boatPicture);

    }

    /**
     * Display a specified BoatPicture.
     */
    public function show(BoatPicture $boatPicture)
    {
        return BoatPictureResource::make($boatPicture);
    }

    /**
     * Update BoatPicture.
     */
    public function update(BoatPictureRequest $request, BoatPicture $boatPicture): BoatPictureResource
    {
        $path = null;
        if ($request->image) {
            $parsedUrl = parse_url($request->image);
            $paths = $parsedUrl['path'];
            $path = substr($paths, strpos($paths, '/storage/') + strlen('/storage/'));
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('boatPictures', $imageName, 'public');
        }
        if (!is_string($request->file('image')) && $path && $boatPicture->picture != $path) {
            Storage::disk('public')->delete($boatPicture->picture);
            $boatPicture->update(['picture' => $path]);
        }
        $boatPicture->update($request->validated());
        return new BoatPictureResource($boatPicture);
    }

    /**
     * Remove BoatPicture.
     */
    public function destroy(BoatPicture $boatPicture): Response
    {
        $boatPicture->delete();

        return response()->noContent();
    }
}
