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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('amount', 8, 2);
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->foreignId('class_room_id')->constrained('class_rooms')->onDelete('cascade');

            $table->text('notes')->nullable();
            $table->string('year');
            $table->integer('fee_type');
            // 1 study
            // 2 Bus

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
