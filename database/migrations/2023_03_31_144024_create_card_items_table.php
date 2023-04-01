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
