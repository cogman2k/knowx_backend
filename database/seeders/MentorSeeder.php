<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Mentor;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mentor::create([
            'user_id'=> '2',
            'subject_id' => '2',
            'description' => 'Hello!'
        ]);

        Mentor::create([
            'user_id'=> '3',
            'subject_id' => '1',
            'description' => 'Hello!'
        ]);

        Mentor::create([
            'user_id'=> '2',
            'subject_id' => '3',
            'description' => 'Hello!'
        ]);

        Mentor::create([
            'user_id'=> '4',
            'subject_id' => '5',
            'description' => 'Hello!'
        ]);

        Mentor::create([
            'user_id'=> '5',
            'subject_id' => '4',
            'description' => 'Hello!'
        ]);

        Mentor::create([
            'user_id'=> '1',
            'subject_id' => '6',
            'description' => 'Hello!'
        ]);

        Mentor::create([
            'user_id'=> '1',
            'subject_id' => '7',
            'description' => 'Hello!'
        ]);

        Mentor::create([
            'user_id'=> '1',
            'subject_id' => '8',
            'description' => 'Hello!'
        ]);
    }
}
