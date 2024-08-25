<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Run the migrations
     *
     * This method is called when the migration is executed
     * It creates the 'movies' table with the specified columns
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Movie title
            $table->string('director'); // Director's name
            $table->string('genre'); // Genre of the movie
            $table->integer('release_year'); // Year of release
            $table->string('description'); // Description of the movie
            $table->timestamps(); // Timestamps for created_at and updated_at
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
