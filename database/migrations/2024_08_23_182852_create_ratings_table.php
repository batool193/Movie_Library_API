<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Run the migrations
     *
     * This method is used to create the 'ratings' table in the database
     * The table includes foreign keys to 'user_id' and 'movie_id', an integer 'rating' field
     * an optional 'review' field, and timestamp fields for 'created_at' and 'updated_at'
     */
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            // Foreign key to the 'users' table
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // Foreign key to the 'movies' table
            $table->foreignId('movie_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // Integer rating field with a constraint to ensure values are between 1 and 5
            $table->integer('rating')->check('rating >= 1 and rating <= 5');
            // Optional review field
            $table->string('review')->nullable();
            // Timestamps for created_at and updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
