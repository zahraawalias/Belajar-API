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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('employeId')->unique();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('email_backup')->nullable();
            $table->string('phone')->nullable();
            $table->string('role');
            $table->string('jobTitle');
            $table->string('groupName');
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
