<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);//->require()->unique();
            $table->foreignId('teacher_id')->constrained()->casCadeOnDelete();
            $table->foreignId('catigory_id')->constrained()->casCadeOnDelete();
            $table->longText('description');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->double('price', 8, 2);
            $table->double('discount', 8, 2);
            $table->string('url_image');//->unique()
            $table->boolean('status')->default(false);
            $table->timestamps();

            // $table->unsignedBigInteger('teacher_id');
            // $table->foreignId('id')->constrained('teachers')->onDelete('cascade');
            // $table->foreignId('id')->constrained('catigories')->onDelete('cascade');
            // $table->unsignedBigInteger('catigory_id');
            // $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            // $table->foreign('catigory_id')->references('id')->on('catigories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
