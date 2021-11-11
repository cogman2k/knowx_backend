<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            User::create([
                'first_name' => 'Trần',
                'last_name' =>  'Huy',
                'full_name' => 'Trần Huy',
                'email' => 'devhuy@gmail.com',
                'password' => Hash::make('123'),
                'phone' => '0984756374',
                'gender' => 'male',
                'birthday' => '06/10/2000',
                'topic' => 'IT',
                'description' => 'Hello Mình là Huy rất mong được làm quen!',
                'image' => 'uploads/user/huy.jpg',
            ]);

            User::create([
                'first_name' => 'Diễm',
                'last_name' =>  'Hồng',
                'full_name' => 'Diễm Hồng',
                'email' => 'diemhong@gmail.com',
                'password' => Hash::make('123'),
                'phone' => '0984756374',
                'gender' => 'female',
                'birthday' => '14/11/2000',
                'topic' => 'IT',
                'description' => 'Hello Mình là Hồng rất mong được làm quen!',
                'image' => 'uploads/user/hong.jpg',
            ]);

            User::create([
                'first_name' => 'Vũ',
                'last_name' =>  'Hiệu',
                'full_name' => 'Vũ Hiệu',
                'email' => 'vuhieu@gmail.com',
                'password' => Hash::make('123'),
                'phone' => '0984756374',
                'gender' => 'male',
                'birthday' => '20/11/2000',
                'topic' => 'IT',
                'description' => 'Hello Mình là Hiệu rất mong được làm quen!',
                'image' => 'uploads/user/hieu.jpg',
            ]);

            User::create([
                'first_name' => 'Nguyễn Lê',
                'last_name' =>  'Duy Anh',
                'full_name' => 'Nguyễn Lê Duy Anh',
                'email' => 'leduyanh@gmail.com',
                'password' => Hash::make('123'),
                'phone' => '0984756374',
                'gender' => 'male',
                'birthday' => '06/06/2000',
                'topic' => 'IT',
                'description' => 'Hello Mình là Anh rất mong được làm quen!',
                'image' => 'uploads/user/duyanh.jpg',
            ]);

            User::create([
                'first_name' => 'Đinh',
                'last_name' =>  'Quang Hòa',
                'full_name' => 'Đinh Quang Hòa',
                'email' => 'quanghoa@gmail.com',
                'password' => Hash::make('123'),
                'phone' => '0984756374',
                'gender' => 'female',
                'birthday' => '06/09/1993',
                'topic' => 'IT',
                'description' => 'Hello Mình là Hòa rất mong được làm quen!',
                'image' => 'uploads/user/hoa.jpg',
            ]);
    }
}
