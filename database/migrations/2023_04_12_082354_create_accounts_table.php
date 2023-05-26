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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('account_type_id')->constrained()->cascadeOnUpdate();
            $table->boolean('is_parent')->default(1);
            $table->bigInteger('parent_id')->nullable();

            $table->string('number')->unique();
            $table->decimal('initial_balance', 10, 2)->default(0);
            $table->tinyInteger('initial_balance_status')->default(1)->comment('1 => balanced, 2 => credit, 3 => debit');
            $table->decimal('current_balance', 10, 2)->default(0);

            $table->string('notes');
            $table->boolean('is_archived')->default(0);
            $table->foreignId('added_by')->nullable()->constrained('admins')->cascadeOnUpdate();

            $table->foreignId('customer_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('vendor_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('delegate_id')->nullable();
            $table->foreignId('production_line_id')->nullable();

            $table->foreignId('company_id');
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