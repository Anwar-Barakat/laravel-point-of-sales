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
        Schema::create('store_transfers', function (Blueprint $table) {
            $table->id();
            $table->date('transfer_date');
            $table->string('notes');
            $table->boolean('is_approved')->default(0);
            $table->decimal('items_cost', 10, 2)->default(0); // all items costs
            $table->foreignId('store_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('to_store')->constrained('stores')->cascadeOnUpdate();
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
        Schema::dropIfExists('store_transfers');
    }
};
