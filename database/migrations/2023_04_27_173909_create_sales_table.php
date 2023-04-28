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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->comment('1 => purchase, 2 => return on the same pill, 3 => return on general');

            $table->boolean('invoice_type');
            $table->date('invoice_date');
            $table->boolean('is_approved')->default(0);
            $table->foreignId('approved_by')->nullable()->constrained('admins')->cascadeOnUpdate();
            $table->boolean('is_account')->default(0);
            $table->string('notes');

            $table->boolean('tax_type')->nullable()->comment('0 => percentage, 1 => fixed');
            $table->decimal('tax_value', 10, 2)->default(0);
            $table->boolean('discount_type')->nullable()->comment('0 => percentage, 1 => fixed');
            $table->decimal('discount_value', 10, 2)->default(0);

            $table->decimal('items_cost', 10, 2)->default(0); // all items costs
            $table->decimal('cost_before_discount', 10, 2)->default(0);
            $table->decimal('cost_after_discount', 10, 2)->default(0);

            $table->decimal('paid', 10, 2)->default(0);
            $table->decimal('remains', 10, 2)->default(0);
            $table->decimal('money_for_account', 10, 2)->default(0);


            $table->foreignId('customer_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('account_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('treasury_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('treasury_transaction_id')->nullable();

            $table->decimal('customer_balance_before', 10, 2)->nullable();
            $table->decimal('customer_balance_after', 10, 2)->nullable();
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
        Schema::dropIfExists('sales');
    }
};
