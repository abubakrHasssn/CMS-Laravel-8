<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\AddCommentRequest;
use App\Models\Post;
use App\Notifications\NewCommentNotification;
use Illuminate\Http\Response;

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param AddCommentRequest $request
     * @param Post $post
     * @return Response
     */
    public function store(AddCommentRequest $request , Post $post)
    {
        auth()->user()->comments()->create([
            'content' => $request->content,
            'post_id' => $post->id
        ]);
        if (auth()->user()->id !== $post->user->id) {
            $post->user->notify(new NewCommentNotification($post));
            }
        session()->flash('success','replied Successfully');
        return redirect()->back();
    }

}
