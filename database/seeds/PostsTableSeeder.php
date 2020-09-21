<?php

use App\Domain\Users\User;
use App\Domain\Posts\Post;

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \Exception
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            $posts = $this->make(random_int(1,5));

            $user->posts()->saveMany($posts);
        }
    }

    /**
     * Create given amount of Posts instances filled with given data.
     *
     * @param int $count
     * @param array $data
     * @return mixed
     */
    public function make(int $count = 5, array $data = [])
    {
        return factory(Post::class, $count)->make($data);
    }
}
