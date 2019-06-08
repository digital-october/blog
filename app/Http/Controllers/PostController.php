<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Domain\Posts\Post;
use App\Domain\Users\User;
use App\Domain\Posts\Status;
use App\Domain\Categories\Category;

use App\Http\Requests\Post\StorePost;
use App\Http\Requests\Post\UpdatePost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $post_query = Post::query();
        $search = $request->search;

        if (!empty($search)) {
            $post_query = $post_query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        }

        return view('posts.index', [
            'posts' => $post_query->orderBy('created_at', 'desc')->simplePaginate(10)
        ]);
    }

    public function userIndex(User $user)
    {
        return view('posts.index', [
            'posts' => $user->posts()->orderBy('created_at', 'desc')->simplePaginate(10)
        ]);
    }

    public function categoryIndex(Category $category)
    {
        return view('posts.index', [
            'posts' => $category->posts()->orderBy('created_at', 'desc')->simplePaginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.form', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePost $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StorePost $request)
    {
        $data = array_except($request->validated(), ['file', 'categories']);
        $categories = $request->categories;

        if ($request->hasFile('file')) {
            $data['file'] = $request->file->store('/', 'public');
        }

        $post = new Post($data);
        $post->user()->associate(User::find($request->user));
        $post->status()->associate(Status::whereSlug(Status::$waiting_moderation)->first());
        $post->save();

        if (!empty($categories)) {
            $post->categories()->syncWithoutDetaching($categories);
        }

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
            'comments' => $post->comments->sortByDesc('created_at'),
            'categories' => $post->categories
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
        $selected = $post->categories;
        $categories = Category::all();

        foreach ($categories as $key => $category) {
            foreach ($selected as $select) {
                if ($select->is($category)) {
                    $categories[$key]['selected'] = true;
                }
            }
        }

        return view('posts.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
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
        $data = array_except($request->validated(), ['file', 'categories']);
        $categories = $request->categories;

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $data['file'] = $request->file->store('/', 'public');
        }

        $post->update($data);

        if (!empty($categories)) {
            $post->categories()->detach($post->categories);
            $post->categories()->syncWithoutDetaching($categories);
        }

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
