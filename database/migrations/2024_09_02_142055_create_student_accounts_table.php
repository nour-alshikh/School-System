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
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');

            $table->foreignId('invoice_id')->nullable()->constrained('invoices')->onDelete('cascade');
            $table->foreignId('receipt_id')->nullable()->constrained('receipts')->onDelete('cascade');
            $table->foreignId('fee_process_id')->nullable()->constrained('fee_processes')->onDelete('cascade');
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('cascade');


            $table->decimal('debit', 8, 2)->nullable();
            $table->decimal('credit', 8, 2)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_accounts');
    }
};
