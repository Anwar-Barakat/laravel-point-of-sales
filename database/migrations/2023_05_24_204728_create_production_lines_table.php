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
        Schema::create('production_lines', function (Blueprint $table) {
            $table->id();
            $table->string('plan');
            $table->date('plan_date');
            $table->boolean('is_approved')->default(0);
            $table->foreignId('approved_by')->nullable()->constrained('admins')->cascadeOnUpdate();
            $table->date('approved_at')->nullable();
            $table->foreignId('added_by')->constrained('admins')->cascadeOnUpdate();
            $table->boolean('is_closed')->default(0);
            $table->foreignId('closed_by')->nullable()->constrained('admins')->cascadeOnUpdate();
            $table->date('closed_at')->nullable();
            $table->foreignId('company_id')->constrained()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_lines');
    }
};
