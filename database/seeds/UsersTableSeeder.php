<?php

use App\Domain\Users\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws Exception
     */
    public function run()
    {
        $this->create(random_int(10, 15));
    }

    /**
     * Create fake data in the right amount
     *
     * @param int $count
     * @param array $data
     * @return mixed
     */
    public function create(int $count = 5, array $data = [])
    {
        return factory(User::class, $count)->create($data);
    }
}
