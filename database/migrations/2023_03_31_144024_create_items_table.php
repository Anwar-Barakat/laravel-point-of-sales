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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('type')->comment('1 => stored, 2 => consuming, 3 => protection');
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate();
            $table->boolean('is_active')->default(1);
            $table->bigInteger('parent_id')->default(0);

            $table->boolean('has_retail_unit')->default(0);
            $table->foreignId('wholesale_unit_id')->constrained('units')->cascadeOnUpdate();
            $table->foreignId('retail_unit_id')->nullable()->constrained('units')->cascadeOnUpdate();

            $table->decimal('wholesale_price', 10, 2);
            $table->decimal('wholesale_price_for_half_block', 10, 2);
            $table->decimal('wholesale_price_for_block', 10, 2);
            $table->decimal('retail_price', 10, 2)->nullable();
            $table->decimal('retail_price_for_block', 10, 2)->nullable();
            $table->decimal('retail_price_for_half_block', 10, 2)->nullable();

            $table->decimal('wholesale_cost_price', 10, 2)->nullable();
            $table->decimal('retail_cost_price', 10, 2)->nullable();
            $table->integer('retail_count_for_wholesale')->nullable();

            $table->decimal('wholesale_qty')->nullable();
            $table->decimal('retail_qty')->nullable();
            $table->decimal('all_retail_qty')->nullable()->comment('all qty in retail unit ');

            $table->boolean('has_fixed_price')->default(1)->comment('Does it has fixed price for invoices?');
            $table->integer('company_code');

            $table->foreignId('added_by')->nullable()->constrained('admins')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
