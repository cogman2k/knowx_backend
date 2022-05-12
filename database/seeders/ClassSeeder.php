<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassList;
use App\Models\Roadmap;
use App\Models\File;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClassList::create([
            'user_id' => '3',
            'name' => 'Lập trình thiết bị di động - Trần Huy',
            'roadmap' => 'none',
            'member' => '0',
            'subject_id' => '2'
        ]);

        ClassList::create([
            'user_id' => '3',
            'name'=>'Kỹ thuật thương mại điện tử (ASP.NET) - Trần Huy',
            'roadmap' => 'none',
            'member' => '0',
            'subject_id' => '5'
        ]);

        Roadmap::create([
            'class_id' => '1',
            'post_id' => '1'
        ]);

        Roadmap::create([
            'class_id' => '2',
            'post_id' => '2'
        ]);

        File::create([
            'subject_id' => '42',
            'file_name' => 'Giao trinh Testing',
            'user_id' => '6',
            'url' => 'uploads/documents/1640180891.docx',
        ]);

        File::create([
            'subject_id' => '27',
            'file_name' => 'Giao trinh Tin Hoc Dai Cuong',
            'user_id' => '7',
            'url' => 'uploads/documents/1640180891.docx',
        ]);

        File::create([
            'subject_id' => '31',
            'file_name' => 'Toan cao cap A1 - Slide',
            'user_id' => '6',
            'url' => 'uploads/documents/1640180891.docx',
        ]);

        File::create([
            'subject_id' => '1',
            'file_name' => 'Introduction to Software Engineering - Roadmap',
            'user_id' => '5',
            'url' => 'uploads/documents/1640180891.docx',
        ]);
    }
}
