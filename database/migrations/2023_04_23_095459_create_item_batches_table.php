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
        Schema::create('item_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('item_id')->constrained()->cascadeOnUpdate();
            // exculsively parent unit
            $table->foreignId('unit_id')->constrained()->cascadeOnUpdate();

            $table->decimal('qty', 10, 2);
            $table->decimal('unit_price', 10, 2)->default(1);
            $table->decimal('total_price', 10, 2)->default(1);

            $table->date('production_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->boolean('is_archieved')->default(0);
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
        Schema::dropIfExists('item_batches');
    }
};
