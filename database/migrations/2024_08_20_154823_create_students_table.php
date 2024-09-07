<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birth_date');
            $table->foreignId('gender_id')->constrained('genders')->onDelete('cascade');
            $table->foreignId('nationality_id')->constrained('nationalities')->onDelete('cascade');
            $table->foreignId('blood_type_id')->constrained('blood_types')->onDelete('cascade');
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->foreignId('class_room_id')->constrained('class_rooms')->onDelete('cascade');
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            $table->foreignId('guardian_id')->constrained('guardians')->onDelete('cascade');
            $table->string('academic_year');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
