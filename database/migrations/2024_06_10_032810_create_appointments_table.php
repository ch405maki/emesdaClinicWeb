<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('dentist_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('appointment_date');
            $table->enum('status', ['pending', 'confirmed', 'completed', 'canceled'])->default('pending');
            
            // Adding new columns
            $table->string('last_dentist')->nullable(); // Name or ID of the last dentist seen
            $table->string('occlusion')->nullable(); // Type of occlusion
            $table->string('dent_anomaly')->nullable(); // Description of dental anomalies
            $table->boolean('good_health')->default(true); // Indicates general health status
            $table->boolean('medical_treatment')->default(false); // If currently under medical treatment
            $table->boolean('surgical_operation')->default(false); // If has undergone any surgical operation
            $table->boolean('hospitalized')->default(false); // If has been hospitalized
            $table->string('medication')->nullable(); // Current medications
            $table->boolean('tobacco')->default(false); // If uses tobacco
            $table->boolean('alcohol')->default(false); // If consumes alcohol
            $table->string('allergy')->nullable(); // Any allergies
            $table->boolean('pregnant')->nullable(); // If the patient is pregnant (use nullable for flexibility)
            $table->text('other')->nullable(); // Any other relevant information

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
