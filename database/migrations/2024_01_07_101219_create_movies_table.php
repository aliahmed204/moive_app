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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id');
            $table->string('title');
            $table->text('description');
            $table->string('poster')->nullable();
            $table->string('banner')->nullable();

            $table->enum('type', ['upcoming', 'playing'])->nullable();

            $table->date('release_date')->nullable();
            $table->double('vote',8,2);
            $table->integer('vote_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
