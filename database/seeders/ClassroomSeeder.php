<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('class_rooms')->delete();

        $classrooms = [

            [
                "name" => [
                    'en' => 'First',
                    'ar' => 'الاولى'
                ],
                "grade_id" => "1"
            ],
            [
                "name" => [
                    'en' => 'Second',
                    'ar' => 'الثانيه'
                ],
                "grade_id" => "1"
            ],
            [
                "name" => [
                    'en' => 'Third',
                    'ar' => 'الثالثة'
                ],
                "grade_id" => "1"
            ],
            [
                "name" => [
                    'en' => 'Forth',
                    'ar' => 'الرابع'
                ],
                "grade_id" => "1"
            ],
            [
                "name" => [
                    'en' => 'Fifth',
                    'ar' => 'الخامس'
                ],
                "grade_id" => "1"
            ],
            [
                "name" => [
                    'en' => 'Sixth',
                    'ar' => 'السادس'
                ],
                "grade_id" => "1"
            ],
            [
                "name" => [
                    'en' => 'First',
                    'ar' => 'الاولى'
                ],
                "grade_id" => "2"
            ],
            [
                "name" => [
                    'en' => 'Second',
                    'ar' => 'الثاني'
                ],
                "grade_id" => "2"
            ],
            [
                "name" => [
                    'en' => 'Third',
                    'ar' => 'الثالث'
                ],
                "grade_id" => "2"
            ],
            [
                "name" => [
                    'en' => 'First',
                    'ar' => 'الاولى'
                ],
                "grade_id" => "3"
            ],
            [
                "name" => [
                    'en' => 'Second',
                    'ar' => 'الثاني'
                ],
                "grade_id" => "3"
            ],
            [
                "name" => [
                    'en' => 'Third',
                    'ar' => 'الثالث'
                ],
                "grade_id" => "3"
            ],
        ];

        foreach ($classrooms as $C) {
            ClassRoom::create([
                'name' => $C['name'],
                'grade_id' => $C['grade_id']
            ]);
        }
    }
}
