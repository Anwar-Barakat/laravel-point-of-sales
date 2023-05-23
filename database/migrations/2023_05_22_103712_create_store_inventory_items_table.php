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
        Schema::create('store_inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_inventory_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('item_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('unit_id')->comment('the main unit')->constrained()->cascadeOnUpdate();
            $table->foreignId('item_batch_id')->constrained()->cascadeOnUpdate();
            $table->integer('old_qty');
            $table->integer('new_qty');
            $table->integer('subtract')->comment('the difference between old and new qty');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);

            $table->date('production_date')->nullable();
            $table->date('expiration_date')->nullable();

            $table->boolean('is_closed')->default(0);
            $table->foreignId('added_by')->constrained('admins')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_inventory_items');
    }
};