<?php

use App\Domain\Posts\Status;

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    public static $statuses = [
        'rejected' => 'Отклонено',
        'accepted' => 'Одобрено',
        'rework' => 'На доработке',
        'check' => 'На проверке',
        'waiting_moderation' => 'Ожидает модерацию'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = self::$statuses;

        foreach ($statuses as $slug => $name) {
            $this->create([
                'slug' => $slug,
                'name' => $name
            ]);
        }
    }

    /**
     * Create Status with given data.
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data) : bool
    {
        return $this->make($data)->save();
    }

    /**
     * Make Status instance filled with given data.
     *
     * @param array $data
     * @return \App\Domain\Posts\Status
     */
    public function make(array $data) : Status
    {
        return new Status($data);
    }
}
