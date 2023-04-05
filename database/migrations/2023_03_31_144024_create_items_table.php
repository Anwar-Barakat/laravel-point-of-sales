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
            $table->string('code')->unique();
            $table->string('barcode');
            $table->string('name');
            $table->tinyInteger('type')->comment('1 => stored, 2 => consuming, 3 => protection');
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate();
            $table->boolean('is_active')->default(1);
            $table->bigInteger('parent_id')->nullable();

            $table->boolean('has_retail_unit')->default(1);
            $table->foreignId('wholesale_unit_id')->constrained('units')->cascadeOnUpdate();
            $table->foreignId('retail_unit_id')->nullable()->constrained('units')->cascadeOnUpdate();

            $table->decimal('wholesale_price');
            $table->decimal('wholesale_price_for_block');
            $table->decimal('wholesale_price_for_half_block');
            $table->decimal('wholesale_cost_price')->comment('the cost average for main unit');
            $table->decimal('retail_price')->nullable();
            $table->decimal('retail_price_for_block')->nullable();
            $table->decimal('retail_price_for_half_block')->nullable();
            $table->decimal('retail_cost_price')->nullable();
            $table->decimal('retail_count_for_wholesale')->nullable();

            $table->decimal('wholesale_qty')->nullable()->comment('qty for wholesale unit');
            $table->decimal('retail|_qty')->nullable()->comment('كمية التجزئة المتبقية من الوحدة الاب في حالة وجود وحدة تجزئة للصنف');
            $table->decimal('all_qty_retails')->nullable()->comment('all qty in retail unit ');

            $table->boolean('has_fixed_price')->default(1)->comment('Does it has fixed price for invoices?');
            $table->date('date')->default(now());
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