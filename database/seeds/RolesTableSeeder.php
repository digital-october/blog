<?php

use App\Domain\Roles\Role;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public static $roles = [
        'root' => 'Root',
        'administrator' => 'Administrator',
        'writer' => 'Writer',
        'redactor' => 'Redactor'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = self::$roles;

        foreach ($roles as $slug => $name) {
            $this->create([
                'slug' => $slug,
                'name' => $name
            ]);
        }
    }

    /**
     * Create Role with given data.
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data) : bool
    {
        return $this->make($data)->save();
    }

    /**
     * Make Role instance filled with given data.
     *
     * @param array $data
     * @return \App\Domain\Roles\Role
     */
    public function make(array $data) : Role
    {
        return new Role($data);
    }
}
