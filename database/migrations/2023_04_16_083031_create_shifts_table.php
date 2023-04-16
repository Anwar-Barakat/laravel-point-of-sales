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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('delivered_admin_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('treasury_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('delivered_treasury_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('delivered_shift_id')->nullable()->constrained()->cascadeOnUpdate();

            $table->decimal('init_treasury_balance');
            $table->datetime('start_date');
            $table->datetime('end_date')->nullable();
            $table->boolean('is_finished')->default(0);
            $table->boolean('is_delivered')->default(0);
            $table->decimal('commission');

            $table->decimal('what_delivered')->default(0);
            $table->tinyInteger('status')->comment('1 => balanced, 2 => extra, 3 => disability');
            $table->decimal('status_money')->default(0);

            $table->boolean('receive_type')->comment('0 => the same treasury, 1 => another treasury');
            $table->dateTime('review_date');
            $table->text('notes');
            $table->integer('company_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};