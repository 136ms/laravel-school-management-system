<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)
            ->has(Group::factory(2))
            ->create([
            'email' => 'test@gmail.com',
            'password' => Hash::make('12345'),
        ]);
        User::factory(9)
            ->has(Group::factory(2))
            ->create();
    }
}
