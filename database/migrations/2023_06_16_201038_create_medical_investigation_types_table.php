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
        Schema::create('medical_investigation_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->foreignIdFor(\App\Models\MedicalInvestigationType::class, 'group_id')
                ->nullable()
                ->constrained('medical_investigation_types')
                ->cascadeOnDelete();
            $table->string('subgroup')->nullable();
            $table->enum('result_type', ['string', 'integer', 'decimal'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_investication_types');
    }
};
