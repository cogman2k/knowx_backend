<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Mentor;
use App\Models\FindBuddy;

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
            'user_id'=> '3',
            'subject_id' => '2',
            'description' => 'Bạn nào khó khăn thì liên hệ mình nha!'
        ]);

        Mentor::create([
            'user_id'=> '4',
            'subject_id' => '1',
            'description' => 'Rất sẵn lòng giúp đỡ các bạn!'
        ]);

        Mentor::create([
            'user_id'=> '5',
            'subject_id' => '3',
            'description' => 'Rất sẵn lòng giúp đỡ các bạn!'
        ]);

        Mentor::create([
            'user_id'=> '3',
            'subject_id' => '5',
            'description' => 'Rất sẵn lòng giúp đỡ các bạn!'
        ]);

        Mentor::create([
            'user_id'=> '6',
            'subject_id' => '4',
            'description' => 'Rất sẵn lòng giúp đỡ các bạn!'
        ]);

        Mentor::create([
            'user_id'=> '4',
            'subject_id' => '6',
            'description' => 'Rất sẵn lòng giúp đỡ các bạn!'
        ]);

        Mentor::create([
            'user_id'=> '5',
            'subject_id' => '7',
            'description' => 'Rất sẵn lòng giúp đỡ các bạn!'
        ]);

        Mentor::create([
            'user_id'=> '6',
            'subject_id' => '8',
            'description' => 'Rất sẵn lòng giúp đỡ các bạn!'
        ]);

        FindBuddy::create([
            'user_id'=> '4',
            'subject_id' => '2',
            'description' => 'Cần tìm bạn cùng học để vượt qua kì thi này!'
        ]);

        FindBuddy::create([
            'user_id'=> '3',
            'subject_id' => '20',
            'description' => 'Cần tìm bạn cùng học để vượt qua kì thi này!'
        ]);

        FindBuddy::create([
            'user_id'=> '5',
            'subject_id' => '19',
            'description' => 'Cần tìm bạn cùng học để vượt qua kì thi này!'
        ]);

        FindBuddy::create([
            'user_id'=> '6',
            'subject_id' => '15',
            'description' => 'Cần tìm bạn cùng học để vượt qua kì thi này!'
        ]);
    }
}
