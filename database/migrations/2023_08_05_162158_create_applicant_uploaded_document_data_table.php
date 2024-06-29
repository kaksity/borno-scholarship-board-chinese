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
        Schema::create('applicant_uploaded_document_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('applicant_id')->index();
            $table->uuid('document_type_id')->index();
            $table->string('file_path');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_uploaded_document_data');
    }
};
