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
        Schema::create('sale_products', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('sale_type')->comment('1 => sectoral, 2 => half_wholesale, 3 => wholesale');
            $table->foreignId('sale_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('store_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('item_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('unit_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('item_batch_id')->constrained()->cascadeOnUpdate();

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
        Schema::dropIfExists('sale_products');
    }
};
