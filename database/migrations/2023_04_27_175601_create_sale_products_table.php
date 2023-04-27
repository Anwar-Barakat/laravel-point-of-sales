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
            $table->foreignId('sale_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('unit_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('item_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('batch_id')->constrained()->cascadeOnUpdate();

            $table->date('production_date')->nullable();
            $table->date('expiration_date')->nullable();

            $table->integer('qty')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->foreignId('added_by')->nullable()->constrained('admins')->cascadeOnUpdate();
            $table->integer('company_code');

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
