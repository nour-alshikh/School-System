<?php

namespace Database\Seeders;

use App\Models\BloodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blood_types')->delete();

        $blood_types = ["O+", "O-", "A+", "A-", "B+", "B-", "AB+", "AB-",];

        foreach ($blood_types as $blood_type) {
            BloodType::create(['name' => $blood_type]);
        }
    }
}
