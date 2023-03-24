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
        Schema::create('treasury_deliveries', function (Blueprint $table) {
            $table->id();
            $table->integer('company_code');
            $table->foreignId('treasury_id')->comment('The treasury that you will receive')->constrained('treasuries')->cascadeOnUpdate();
            $table->foreignId('treasury_delivery_id')->comment('The treasury that will be delivered')->constrained('treasuries')->cascadeOnUpdate();
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
        Schema::dropIfExists('treasury_deliveries');
    }
};