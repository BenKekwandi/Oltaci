<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;

class CommentController extends Controller
{
    /** Get Comment list */
    public function index(): AnonymousResourceCollection
    {
        return CommentResource::collection(Comment::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Comment list admin */
    public function allComments(): AnonymousResourceCollection
    {
        return CommentResource::collection(Comment::all());
    }

    /**
     * Store Comment.
     */
    public function store(CommentRequest $request): CommentResource
    {
        return new CommentResource(Comment::create($request->validated()));
    }

    /**
     * Display a specified Comment.
     */
    public function show(Comment $Comment)
    {
        return CommentResource::make($Comment);
    }


    /**
     * Update Comment.
     */
    public function update(CommentRequest $request, Comment $Comment): CommentResource
    {
        return new CommentResource($Comment->update($request->validated()));
    }

    /**
     * Remove Comment.
     */
    public function destroy(Comment $Comment): Response
    {
        $Comment->delete();

        return response()->noContent();
    }
}
