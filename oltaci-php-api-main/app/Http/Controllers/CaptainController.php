<?php

namespace App\Http\Controllers;

use App\Http\Requests\CaptainRequest;
use App\Http\Resources\CaptainResource;
use App\Models\Captain;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;
use Log;



class CaptainController extends Controller
{
    /** Get Captain list */
    public function index(): AnonymousResourceCollection
    {
        return CaptainResource::collection(Captain::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Captain list admin */
    public function allCaptains(): AnonymousResourceCollection
    {
        return CaptainResource::collection(Captain::all());
    }

    /**
     * Store Captain.
     */
    public function store(CaptainRequest $request): CaptainResource
    {
        Log::info($request->all());

        $path = null;
        if ($request->profile_picture) {
            $parsedUrl = parse_url($request->profile_picture);
            $paths = $parsedUrl['path'];
            $path = substr($paths, strpos($paths, '/storage/') + strlen('/storage/'));
        }

        if ($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $profile_pictureName = time() . '_' . uniqid() . '.' . $profile_picture->getClientOriginalExtension();
            $path = $profile_picture->storeAs('captains', $profile_pictureName, 'public');
        }

        $validatedData = $request->validated();
        $validatedData['availability_status'] = $request->availability_status === 'false' ? false : true;
        $validatedData['profile_picture'] = $path;
        $captain = Captain::create($validatedData);

        return new CaptainResource($captain);
    }

    /**
     * Display a specified Captain.
     */
    public function show(Captain $Captain)
    {
        return CaptainResource::make($Captain);
    }


    /**
     * Update Captain.
     */
    public function update(CaptainRequest $request, Captain $captain)
    {
        Log::info($request->all());

        $path = null;
        if ($request->profile_picture) {
            $parsedUrl = parse_url($request->profile_picture);
            $paths = $parsedUrl['path'];
            $path = substr($paths, strpos($paths, '/storage/') + strlen('/storage/'));
        }

        if ($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $profile_pictureName = time() . '_' . uniqid() . '.' . $profile_picture->getClientOriginalExtension();
            $path = $profile_picture->storeAs('captains', $profile_pictureName, 'public');
        }
        
        // if (!is_string($request->file('profile_picture')) && $path && $captain->profile_picture != $path) {
        //     Storage::disk('public')->delete($captain->profile_picture);
        // }

        $validatedData = $request->validated();
        unset($validatedData['profile_picture']);
        $captain->update([
            'profile_picture' => $path,
        ]);
        $captain->update($validatedData);
        return new CaptainResource($captain);
    }

    /**
     * Remove Captain.
     */
    public function destroy(Captain $Captain): Response
    {
        $Captain->delete();

        return response()->noContent();
    }
}
