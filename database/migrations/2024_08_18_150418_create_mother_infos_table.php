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
        Schema::create('mother_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('national_id');
            $table->string('passport_id');
            $table->string('phone');
            $table->string('job');
            $table->string('address');

            $table->foreignId('blood_type_id')->constrained('blood_types')->onDelete('cascade');
            $table->foreignId('nationality_id')->constrained('nationalities')->onDelete('cascade');
            $table->foreignId('religion_id')->constrained('religions')->onDelete('cascade');

            $table->foreignId('guardian_id')->constrained("guardians")->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mother_infos');
    }
};
