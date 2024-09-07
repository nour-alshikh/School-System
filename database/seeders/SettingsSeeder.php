<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('settings')->delete();

        $data = [
            ['key' => "current_session", 'value' => "2024-2025"],
            ['key' => "school_title", 'value' => "NS"],
            ['key' => "school_name", 'value' => "N School"],
            ['key' => "end_first_name", 'value' => "01-02-2025"],
            ['key' => "end_second_name", 'value' => "01-06-2025"],
            ['key' => "phone", 'value' => "0123456789"],
            ['key' => "address", 'value' => "cairo"],
            ['key' => "email", 'value' => "school@edu.com"],
            ['key' => "logo", 'value' => "default.jpg"],
        ];
        DB::table('settings')->insert($data);
    }
}
