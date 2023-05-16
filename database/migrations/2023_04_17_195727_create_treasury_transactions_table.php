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
        Schema::create('treasury_transactions', function (Blueprint $table) {
            $table->id();
            $table->date('transaction_date');
            $table->foreignId('shift_type_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('shift_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('admin_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('treasury_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('order_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('account_id')->nullable()->constrained()->cascadeOnUpdate();

            $table->boolean('is_account');
            $table->boolean('is_approved');

            $table->integer('payment');
            $table->decimal('money', 10, 2)->default(0);
            $table->decimal('money_for_account', 10, 2)->default(0);
            $table->text('report');
            $table->foreignId('company_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treasury_transactions');
    }
};