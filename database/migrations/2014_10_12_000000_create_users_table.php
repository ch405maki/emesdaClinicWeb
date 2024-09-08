<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            // Additional fields
            $table->integer('age')->nullable();
            $table->string('sex')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('course_year')->nullable();
            $table->string('contact')->nullable();
            $table->string('position')->nullable();
            $table->string('address')->nullable();
            $table->string('ioe_name')->nullable();
            $table->string('ioe_relation')->nullable();
            $table->string('ioe_address')->nullable();
            $table->string('ioe_contact')->nullable();

            $table->string('password');
            $table->string('role')->default('student');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}

