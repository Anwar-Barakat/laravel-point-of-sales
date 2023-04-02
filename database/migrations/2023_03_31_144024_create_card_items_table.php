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
        Schema::create('card_items', function (Blueprint $table) {
            $table->id();
            $table->string('barcode');
            $table->string('item_name');
            $table->tinyInteger('item_type')->comment('1 => stored, 2 => consuming, 3 => protection');
            $table->integer('parent_id');
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate();
            $table->boolean('is_active')->default(1);

            $table->boolean('has_retail_unit')->default(1)->comment('Does it has a retails unit');
            $table->foreignId('wholesale_unit_id')->constrained('units')->cascadeOnUpdate();
            $table->foreignId('retail_unit_id')->constrained('units')->cascadeOnUpdate();
            $table->decimal('retail_count_for_wholesale');

            $table->decimal('wholesale_price')->comment('the sectional price for the main unit');
            $table->decimal('wholesale_price_for_block');
            $table->decimal('wholesale_price_for_half_block');
            $table->decimal('wholesale_cost_price')->comment('the cost average for main unit');
            $table->decimal('retail_price')->nullable();
            $table->decimal('retail_price_for_block')->nullable();
            $table->decimal('retail_price_for_half_block')->nullable();
            $table->decimal('retail_cost_price')->nullable();

            $table->decimal('wholesale_qty')->comment('qty for wholesale unit');
            $table->decimal('retail|_qty')->comment('كمية التجزئة المتبقية من الوحدة الاب في حالة وجود وحدة تجزئة للصنف');
            $table->decimal('all_qty_retails')->comment('all qty in retail unit ');

            $table->boolean('has_fixed_price')->default(1)->comment('Does it has fixed price for invoices?');
            $table->date('date');
            $table->integer('company_code');
            $table->bigInteger('code');

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
        Schema::dropIfExists('cards');
    }
};
