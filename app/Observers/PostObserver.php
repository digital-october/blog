<?php

namespace App\Observers;

use App\Domain\Posts\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    /**
     * Handle the post "deleting" event.
     *
     * @param Post $post
     */
    public function deleting(Post $post)
    {
        if (!empty($post->file) && Storage::disk('public')->exists($post->file)) {
            Storage::disk('public')->delete($post->file);
        }
    }
}
