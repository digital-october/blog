<?php

namespace App\Http\Controllers;

use App\Domain\Posts\Post;
use App\Domain\Users\User;
use App\Domain\Comments\Comment;

use App\Http\Requests\Comment\StoreComment;

class CommentController extends Controller
{
    /**
     * Create a comment in the post
     *
     * @param StoreComment $request
     * @param Post $post
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreComment $request, Post $post, User $user)
    {
        $comment = new Comment($request->validated());
        $comment->post()->associate($post);
        $comment->user()->associate($user);
        $comment->save();

        return redirect()->back();
    }

    /**
     * Remove the one comment
     *
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroyComment(Comment $comment)
    {
        $comment->delete();

        return redirect()->back();
    }
}
