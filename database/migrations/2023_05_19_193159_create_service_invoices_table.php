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
        Schema::create('service_invoices', function (Blueprint $table) {
            $table->id();
            $table->boolean('service_type')->comment('0 => internal, 1 => external');

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

            $table->decimal('services_cost', 10, 2)->default(0);
            $table->decimal('cost_before_discount', 10, 2)->default(0);
            $table->decimal('cost_after_discount', 10, 2)->default(0);

            $table->decimal('paid', 10, 2)->default(0);
            $table->decimal('remains', 10, 2)->default(0);
            $table->decimal('money_for_account', 10, 2)->default(0);


            $table->foreignId('account_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('treasury_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('treasury_transaction_id')->nullable();

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
        Schema::dropIfExists('service_invoices');
    }
};
