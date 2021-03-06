<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            SubjectSeeder::class,
            MentorSeeder::class,
            FollowSeeder::class,
            JobSeeder::class,
            ClassSeeder::class,
        ]);
    }
}
