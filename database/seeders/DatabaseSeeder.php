<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'people',
                'email' => 'people@gmail.com',
                'status' => '0',
                'password' => bcrypt('1234')
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'status' => '1',
                'password' => bcrypt('1234')
            ],

        ];
        $category = [
            [
                'name' => 'ท่องเที่ยว'
            ]
        ];
        foreach ($category as $user) {
            DB::table('categories')->insert($user);
        }
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
