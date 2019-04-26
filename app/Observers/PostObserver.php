<?php

namespace App\Observers;

use App\Domain\Posts\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    /**
     * Handle the post "updating" event.
     *
     * @param  Post $post
     * @return void
     */
    public function updating(Post $post)
    {
        $original_post = $post->getOriginal('file');

        if ($post->file !== $original_post && Storage::disk('public')->exists($original_post)) {
            Storage::disk('public')->delete($original_post);
        }
    }

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
