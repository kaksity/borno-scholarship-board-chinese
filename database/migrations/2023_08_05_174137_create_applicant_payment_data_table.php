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
        Schema::create('applicant_payment_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('applicant_id')->index();
            $table->decimal('amount');
            $table->string('order_id')->nullable();
            $table->string('rrr')->nullable();
            $table->string('status')->default('pending');
            $table->date('completed_payment_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_payment_data');
    }
};
