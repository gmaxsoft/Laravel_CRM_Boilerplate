<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Uruchom migracje.
     */
    public function up(): void
    {
        Schema::create('crm_document_files', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ścieżka w storage, np. documents/xyz.pdf
            $table->string('original_name');
            $table->unsignedBigInteger('size')->default(0);
            $table->string('mime_type', 100)->nullable();
            $table->foreignId('user_id')->constrained('crm_users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_document_files');
    }
};
