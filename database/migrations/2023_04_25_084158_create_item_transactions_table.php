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
        Schema::create('item_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_transaction_category_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('item_transaction_type_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('item_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('order_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('store_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('order_product_id')->constrained()->cascadeOnUpdate();
            $table->string('report');
            $table->string('store_qty_before_transaction');
            $table->string('store_qty_after_transaction');
            $table->string('qty_before_transaction');
            $table->string('qty_after_transaction');
            $table->foreignId('added_by')->constrained('admins')->cascadeOnUpdate();
            $table->integer('company_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_transactions');
    }
};
