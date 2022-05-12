<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UserFollow;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        UserFollow::create([
            'user_id' => '3',
            'target_user_id' => '7'
        ]);

        UserFollow::create([
            'user_id' => '3',
            'target_user_id' => '6'
        ]);
        
        UserFollow::create([
            'user_id' => '3',
            'target_user_id' => '8'
        ]);

        UserFollow::create([
            'user_id' => '3',
            'target_user_id' => '4'
        ]);

        UserFollow::create([
            'user_id' => '4',
            'target_user_id' => '3'
        ]);

        UserFollow::create([
            'user_id' => '5',
            'target_user_id' => '3'
        ]);
    }
}
