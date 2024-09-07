<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grades')->delete();

        $grades = [

            [
                "name" => [
                    'en' => 'Primary',
                    'ar' => 'الابتدائية'
                ],
                "notes" => "No Notes"
            ],
            [
                "name" => [
                    'en' => 'Middle',
                    'ar' => 'الاعدادية'
                ],
                "notes" => "No Notes"
            ],
            [
                "name" => [
                    'en' => 'High',
                    'ar' => 'الثانوية'
                ],
                "notes" => "No Notes"
            ],


        ];

        foreach ($grades as $G) {
            Grade::create([
                'name' => $G['name'],
                'notes' => $G['notes']
            ]);
        }
    }
}
