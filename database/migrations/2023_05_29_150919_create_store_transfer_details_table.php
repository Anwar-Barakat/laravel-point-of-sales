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
        Schema::create('store_transfer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_transfer_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('item_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('unit_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('from_item_batch')->constrained('item_batches')->cascadeOnUpdate();
            $table->foreignId('to_item_batch')->constrained('item_batches')->cascadeOnUpdate();

            $table->date('production_date')->nullable();
            $table->date('expiration_date')->nullable();

            $table->integer('qty')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->foreignId('added_by')->nullable()->constrained('admins')->cascadeOnUpdate();
            $table->foreignId('company_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_transfer_details');
    }
};