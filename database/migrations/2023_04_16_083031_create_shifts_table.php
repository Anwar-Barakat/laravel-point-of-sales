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
            $table->foreignId('delivered_admin_id')->nullable()->constrained('admins')->cascadeOnUpdate();
            $table->foreignId('treasury_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('delivered_treasury_id')->nullable()->constrained('treasuries')->cascadeOnUpdate();
            $table->foreignId('delivered_shift_id')->nullable()->constrained('shifts')->cascadeOnUpdate();

            $table->decimal('init_treasury_balance', 10, 2)->default(0);
            $table->datetime('date_opened')->nullable();
            $table->datetime('date_closed')->nullable();
            $table->boolean('is_finished')->default(0);
            $table->boolean('is_delivered')->default(0);
            $table->decimal('commission', 10, 2)->default(0);

            $table->decimal('what_delivered', 10, 2)->default(0);
            $table->tinyInteger('status')->default(1)->comment('1 => balanced, 2 => extra, 3 => disability');
            $table->decimal('status_money', 10, 2)->default(0);

            $table->boolean('receive_type')->nullable()->comment('0 => the same treasury, 1 => another treasury');
            $table->boolean('is_reviewed')->default(0);
            $table->dateTime('review_date')->nullable();
            $table->string('notes')->nullable();
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
