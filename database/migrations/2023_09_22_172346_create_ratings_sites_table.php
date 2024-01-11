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
        Schema::create('ratings_sites', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->tinyInteger('type_user');
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
        Schema::dropIfExists('ratings_sites');
    }
};
