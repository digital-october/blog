<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::get()->sortByDesc('created_at')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.form');
    }

    /**
     * Create comment for one Post
     *
     * @param Request $request
     * @param Post $post
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createComment(Request $request, Post $post, User $user)
    {
        $post->comments()->create([
            'text' => $request->comment,
            'user_id' => $user->id
        ]);

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        $user->post()->create([
            'heading' => $request->heading,
            'body' => $request->body,
        ]);

        return redirect(route('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'comments' => Comment::where('post_id', '=', $post->id)->get()->sortByDesc('created_at')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', [
            'heading' => $post->heading,
            'body' => $post->body,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->update([
            'heading' => $request->heading,
            'body' => $request->body,
        ]);

        return redirect(route('posts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();

        return redirect(route('posts'));
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
