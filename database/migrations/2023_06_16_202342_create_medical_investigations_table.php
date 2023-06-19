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
        Schema::create('medical_investigations', function (Blueprint $table) {
            $table->id();
            $table->string('result')->nullable();
            $table->foreignIdFor(\App\Models\MedicalInvestigationType::class, 'investigation_type')
                ->constrained('medical_investigation_types')
                ->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\MedicalRecord::class, 'medical_record_id')
                ->constrained('medical_records')
                ->cascadeOnDelete();
            $table->timestamps(); // Laboratory
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_investigations');
    }
};
