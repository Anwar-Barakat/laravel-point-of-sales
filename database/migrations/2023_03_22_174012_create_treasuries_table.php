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
        Schema::create('treasuries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('admin_id')->constrained()->cascadeOnUpdate();
            $table->boolean('is_master')->default(0);
            $table->boolean('is_active')->default(1);
            $table->integer('company_code');
            $table->integer('last_payment_receipt')->default(1);
            $table->integer('last_payment_collect')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treasuries');
    }
};
