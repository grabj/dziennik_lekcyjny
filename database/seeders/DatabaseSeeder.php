<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'admin',
                'surname' => 'testowy',
                'email' => 'admin@test.com',
                'role' => '0',
                'password' => Hash::make('password')
            ]
        );
        User::firstOrCreate(
            ['id' => 2],
            [
                'name' => 'lecturer',
                'surname' => 'testowy',
                'email' => 'lecturer@test.com',
                'role' => '1',
                'password' => Hash::make('password')
            ]
        );
        User::firstOrCreate(
            ['id' => 3],
            [
                'name' => 'student',
                'surname' => 'testowy',
                'email' => 'student@test.com',
                'role' => '2',
                'password' => Hash::make('password')
            ]
        );
        User::factory(10)->create();
        Grade::factory(50)->create();
    }
}
