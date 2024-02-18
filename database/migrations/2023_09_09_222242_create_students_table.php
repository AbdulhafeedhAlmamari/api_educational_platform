<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->tinyInteger('gender');
            $table->string('phone_number');
            $table->string('address');
            $table->string('password');
            $table->string('url_image')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('social_id')->nullable();
            $table->string('social_type')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
