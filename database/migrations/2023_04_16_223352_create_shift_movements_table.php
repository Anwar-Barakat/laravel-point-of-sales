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
        Schema::create('shift_movements', function (Blueprint $table) {
            $table->id();
            $table->integer('movement_type');
            $table->foreignId('shift_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('admin_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('treasury_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('order_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('account_id')->nullable()->constrained()->cascadeOnUpdate();

            $table->boolean('is_account');
            $table->boolean('is_approved');

            $table->decimal('money')->default(0);
            $table->decimal('money_for_account')->default(0);
            $table->integer('company_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_movements');
    }
};
