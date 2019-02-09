<?php

use App\Domain\Users\User;
use App\Domain\Posts\Post;
use App\Domain\Comments\Comment;

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \Exception
     */
    public function run()
    {
        $this->create(random_int(10,20));
    }

    /**
     * @param array $data
     * @param int $count
     */
    public function create(int $count, array $data = [])
    {
        $posts = Post::all();
        $users = User::all();

        while ($count) {
            $comment = $this->make($data);

            $post = $posts->random(1)->first()->id;
            $user = $users->random(1)->first()->id;

            $comment->post()->associate($post);
            $comment->user()->associate($user);
            $comment->save();

            $count--;
        }
    }

    /**
     * Make Comments instance filled with given data.
     *
     * @param array $data
     * @return App\Domain\Comments\Comment
     */
    public function make(array $data = []): Comment
    {
        return factory(Comment::class)->make($data);
    }
}
