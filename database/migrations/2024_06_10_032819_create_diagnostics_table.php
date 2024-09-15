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
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
            $table->text('description');
            $table->string('service_rendered', 255)->default('Not specified');
            $table->string('remarks', 255)->nullable();
            $table->text('dental_chart')->nullable();
            
            $table->string('occlusion', 255)->nullable();
            $table->string('condition', 255)->nullable();
            $table->string('hygiene', 255)->nullable();
            $table->string('denture_upper', 255)->nullable();
            $table->string('denture_lower', 255)->nullable();
            $table->string('since_upper', 255)->nullable();
            $table->string('since_lower', 255)->nullable();
            $table->string('abnormalities', 255)->nullable();
            $table->string('general_condition', 255)->nullable();
            $table->string('physician', 255)->nullable();
            $table->string('nature_treatment', 255)->nullable();
            $table->string('alergies', 255)->nullable();
            $table->string('history', 255)->nullable();
            $table->string('ailments', 255)->nullable();
            $table->string('bp', 255)->nullable();
            $table->string('drugs', 255)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostics');
    }
};
