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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alert_msg');
            $table->string('address');
            $table->string('mobile');
            $table->boolean('is_active')->default(1);

            $table->foreignId('parent_customer_id')->nullable();
            $table->foreignId('parent_vendor_id')->nullable();
            $table->foreignId('parent_delegate_id')->nullable();
            $table->foreignId('admin_id')->constrained()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
