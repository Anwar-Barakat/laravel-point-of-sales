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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->comment('1 => purchase, 2 => return on the same pill, 3 => return on general');

            $table->boolean('invoice_type');
            $table->date('invoice_date');
            $table->boolean('is_approved')->default(0);
            $table->string('notes');

            $table->boolean('discount_type')->default(0)->comment('0 => percentage, 1 => fixed');
            $table->decimal('discount')->default(0);
            $table->boolean('tax_type')->default(0)->comment('0 => percentage, 1 => fixed');
            $table->decimal('tax')->default(0);

            $table->decimal('items_cost')->default(0); // all items costs
            $table->decimal('cost_before_discount')->default(0);
            $table->decimal('cost_after_discount')->default(0);

            // $table->decimal('paid')->default(0);
            // $table->decimal('remains')->default(0);

            // $table->decimal('grand_cost');

            $table->foreignId('vendor_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('account_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('store_id')->constrained()->cascadeOnUpdate();
            // $table->decimal('vendor_balance_before')->nullable();
            // $table->decimal('vendor_balance_after')->nullable();
            // $table->foreignId('treasury_id')->nullable()->constrained()->cascadeOnUpdate();
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
        Schema::dropIfExists('orders');
    }
};
