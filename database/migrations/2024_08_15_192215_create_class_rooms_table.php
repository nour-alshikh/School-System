<?php

use App\Models\Grade;
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
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->foreignIdFor(Grade::class, 'id')->onDelete("cascade")->onUpdate('cascade');
            $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_rooms');
    }
};
