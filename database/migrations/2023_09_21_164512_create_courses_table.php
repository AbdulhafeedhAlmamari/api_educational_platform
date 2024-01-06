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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);//->require()->unique();
            $table->foreignId('teacher_id')->constrained()->casCadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained()->casCadeOnDelete()->cascadeOnUpdate();
            $table->longText('description');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->double('price', 8, 2);
            $table->double('discount', 8, 2);
            $table->string('url_image');//->unique()
            $table->boolean('status')->default(false);
            $table->timestamps();
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
