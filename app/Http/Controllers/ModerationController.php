<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Domain\Posts\Magazine;
use App\Domain\Posts\Post;
use App\Domain\Posts\Status;

use App\Mail\RejectPost;
use App\Mail\ReworkPost;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ModerationController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::query()
                ->where('status_id', Status::getSlugID(Status::$waiting_moderation))
                ->orderBy('created_at', 'desc')
                ->simplePaginate(10)
        ]);
    }


    public function accepted(Post $post)
    {
        $status = Status::getSlugID(Status::$accepted);

        $now = Carbon::now();

        $magazines = Magazine::whereMonth('created_at', '=', $now->format('m'))->get();

        if ($magazines->count()){
            $magazine = $magazines->first();
        } else {
            $magazine = Magazine::create(['created_at' => $now]);
        }

        $post->update([
            'published_at' => $now
        ]);
        $post->magazine()->associate($magazine);
        $post->status()->associate($status);
        $post->save();

        return redirect()->back()->with('message', 'Успешно одобрено.');
    }


    public function rework(Request $request, Post $post)
    {
        $status = Status::getSlugID(Status::$rework);

        $post->status()->associate($status);
        $post->save();
        $post->message = $request->message;

        Mail::to($post->user->email)->send(new ReworkPost($post));

        return redirect()->back()->with('message', 'Успешно отправлено на доработку.');
    }

    public function reject(Request $request, Post $post)
    {
        $status = Status::getSlugID(Status::$rejected);

        $post->status()->associate($status);
        $post->save();
        $post->message = $request->message;

        Mail::to($post->user->email)->send(new RejectPost($post));

        return redirect()->back()->with('message', 'Успешно отклонена.');
    }
}
