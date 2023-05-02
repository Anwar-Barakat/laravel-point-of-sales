<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('address')->nullable();

            $table->decimal('initial_balance', 10, 2)->default(0);
            $table->tinyInteger('initial_balance_status')->default(1)->comment('1 => balanced, 2 => credit, 3 => debit');
            $table->decimal('current_balance', 10, 2)->default(0);

            $table->string('notes');
            $table->foreignId('company_id');
            $table->boolean('is_active')->default(1);
            $table->foreignId('added_by')->nullable()->constrained('admins')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
