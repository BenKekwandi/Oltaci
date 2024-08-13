<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Log;

class PostController extends Controller
{
    /** Get Post list */
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::with('comments')->sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Post list admin */
    public function allPosts(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::with('comments')->orderByDesc('id')->get());
    }

    /**
     * Store Post.
     */
    public function store(PostRequest $request): PostResource
    {
        $path = null;
        Log::info('Request: ', $request->all());
        if ($request->hasFile('media')) {
            $media = $request->file('media');
            Log::info('Here is the file: ');
            Log::info($media);
            $mediaName = time() . '_' . uniqid() . '.' . $media->getClientOriginalExtension();
            $path = $media->storeAs('posts', $mediaName, 'public');
        }
        else{
            Log::info('No request file media');
        }
        $validatedData = $request->validated();
        $validatedData['media'] = $path;
        $post = Post::create($validatedData);
        return new PostResource($post);
    }

    /**
     * Display a specified Post.
     */
    public function show(Post $Post)
    {
        return PostResource::make($Post);
    }


    /**
     * Update Post.
     */
    public function update(PostRequest $request, Post $Post): PostResource
    {
        $path = null;
        if ($request->picture) {
            $parsedUrl = parse_url($request->picture);
            $paths = $parsedUrl['path'];
            $path = substr($paths, strpos($paths, '/storage/') + strlen('/storage/'));
        }

        if ($request->hasFile('media')) {
            $media = $request->file('media');
            $mediaName = time() . '_' . uniqid() . '.' . $media->getClientOriginalExtension();
            $path = $media->storeAs('posts', $mediaName, 'public');
        }

        if (!is_string($request->file('media')) && $path && $Post->media != $path) {
            Storage::disk('public')->delete($Post->media);
            $Post->update(['media' => $path]);
        }
        return new PostResource($Post->update($request->validated()));
    }

    /**
     * Remove Post.
     */
    public function destroy(Post $Post): Response
    {
        $Post->delete();

        return response()->noContent();
    }
}
