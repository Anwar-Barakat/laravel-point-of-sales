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
        Schema::create('financial_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('account_type_id')->constrained()->cascadeOnUpdate();
            $table->boolean('is_parent')->default(0);
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('account_number')->comment('not duplicated at the company level');
            $table->decimal('initial_balance')->default(0)->comment('credit-debit-balanced at the beginning');
            $table->decimal('currnet_balance')->default(0)->comment('credit-debit-balanced at the beginning');
            $table->string('notes');
            $table->integer('company_code');
            $table->boolean('is_archived')->default(0);
            $table->boolean('is_active')->default(0);
            $table->foreignId('added_by')->nullable()->constrained('admins')->cascadeOnUpdate();
            $table->date('date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};