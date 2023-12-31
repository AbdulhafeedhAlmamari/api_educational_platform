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
        Schema::create('ratings_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('comment');
            $table->tinyInteger('status');
            $table->integer('degree');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings_courses');
    }
};
