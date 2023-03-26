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
        Schema::create('invoice_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('company_code');
            $table->foreignId('added_by')->nullable()->constrained('admins')->cascadeOnUpdate();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_categories');
    }
};