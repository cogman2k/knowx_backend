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
            'first_name' => 'admin',
            'last_name' =>  '1',
            'full_name' => 'admin 1',
            'role' => 'admin',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('11111111Aa'),
            'phone' => '098471231231',
        ]);

        User::create([
            'first_name' => 'Rikkei',
            'last_name' =>  'Soft',
            'full_name' => 'RikkeiSoft',
            'role' => 'company',
            'email' => 'rikkei@gmail.com',
            'password' => Hash::make('11111111Aa'),
            'phone' => '0984756374',
            'image' => 'uploads/user/rikkei.png',
            'address' => "81 Quang Trung St, Hai Chau District, Da Nang City"
        ]);

        User::create([
            'first_name' => 'Enclave',
            'last_name' =>  'Company',
            'full_name' => 'Enclave',
            'role' => 'company',
            'email' => 'enclave@gmail.com',
            'password' => Hash::make('11111111Aa'),
            'phone' => '0984756374',
            'image' => 'uploads/user/enclave.jpg',
            'address' => " 455 Hoang Dieu st, Hai Chau District, Da Nang City",
        ]);

        User::create([
            'first_name' => 'MGM Technology Partners',
            'last_name' =>  'Company',
            'full_name' => 'MGM Technology',
            'role' => 'company',
            'email' => 'mgm@gmail.com',
            'password' => Hash::make('11111111Aa'),
            'phone' => '0984756374',
            'image' => 'uploads/user/mgm.png',
            'address' => "7 Phan Chau Trinh St, Hai Chau District, Da Nang City"
        ]);

        User::create([
            'first_name' => "FPT Software",
            'last_name' =>  'Company',
            'full_name' => 'FPT Software',
            'role' => 'company',
            'email' => 'fptsoftware@gmail.com',
            'password' => Hash::make('11111111Aa'),
            'phone' => '0984756374',
            'image' => 'uploads/user/fpt.jpg',
            'address' => "FPT Building, Road No.1, Son Tra District, Da Nang City",
        ]);

            User::create([
                'first_name' => 'Trần',
                'last_name' =>  'Huy',
                'full_name' => 'Trần Huy',
                'role' => 'student',
                'email' => 'devhuy@gmail.com',
                'password' => Hash::make('11111111Aa'),
                'phone' => '0984756374',
                'gender' => 'Male',
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
                'password' => Hash::make('11111111Aa'),
                'phone' => '0984756374',
                'gender' => 'Female',
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
                'password' => Hash::make('11111111Aa'),
                'phone' => '0984756374',
                'gender' => 'Male',
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
                'password' => Hash::make('11111111Aa'),
                'phone' => '0984756374',
                'gender' => 'Male',
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
                'password' => Hash::make('11111111Aa'),
                'phone' => '0984756374',
                'gender' => 'Female',
                'birthday' => '06/09/1993',
                'topic' => 'IT',
                'description' => 'Hello Mình là Hòa rất mong được làm quen!',
                'image' => 'uploads/user/hoa.jpg',
            ]);

            User::create([
                'first_name' => 'Trần Văn',
                'last_name' =>  'Lực',
                'full_name' => 'Trần Văn Lực',
                'email' => 'tranvanluc@gmail.com',
                'password' => Hash::make('11111111Aa'),
                'phone' => '0375683594',
                'gender' => 'Male',
                'birthday' => '08/09/2000',
                'topic' => 'IT',
                'description' => 'Hello Mình là Lực rất mong được làm quen!',
                'image' => 'uploads/user/1640337232.jpg',
            ]);

            User::create([
                'first_name' => 'Trần Văn',
                'last_name' =>  'Khoa',
                'full_name' => 'Trần Văn Khoa',
                'email' => 'tranvankhoa@gmail.com',
                'password' => Hash::make('11111111Aa'),
                'phone' => '0985746375',
                'gender' => 'Male',
                'birthday' => '06/08/2000',
                'topic' => 'IT',
                'description' => 'Hello Mình là Khoa rất mong được làm quen!',
                'image' => 'uploads/user/1640344182.jpg',
            ]);
    }
}
