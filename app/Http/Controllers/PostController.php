<?php

namespace App\Http\Controllers;

use App\Domain\Posts\Post;
use App\Domain\Posts\Status;
use App\Domain\Users\User;

use App\Http\Requests\Post\StorePost;
use App\Http\Requests\Post\UpdatePost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::query()->orderBy('created_at', 'desc')->simplePaginate(10)
        ]);
    }

    public function userIndex(User $user)
    {
        return view('posts.index', [
            'posts' => $user->posts()->orderBy('created_at', 'desc')->simplePaginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePost $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StorePost $request)
    {
        $data = array_except($request->validated(), ['file']);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file->store('/', 'public');
        }

        $post = new Post($data);
        $post->user()->associate(User::find($request->user));
        $post->status()->associate(Status::whereSlug(Status::$waiting_moderation)->first());
        $post->save();

        return redirect(route('posts.index'));
    }


    public function download(Post $post)
    {
        return response()->download(storage_path("app/public/{$post->file}"));
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
            'comments' => $post->comments->sortByDesc('created_at')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePost $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdatePost $request, Post $post)
    {
        $post->update($request->validated());

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect(route('posts.index'));
    }
}
