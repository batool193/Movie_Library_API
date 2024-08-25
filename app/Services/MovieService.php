<?php
namespace App\Services;

use App\Models\Movie;

class MovieService {

     /**
     * Create a new movie record in the database
     *
     * @param array $data The data to create the movie with
     * @return \App\Models\Movie The created movie instance
     */

    public function createMovie(array $data) {
        return Movie::create($data);
    }

     /**
     * Update an existing movie record in the database
     *
     * @param array $data The data to update the movie with
     * @param \App\Models\Movie $movie The movie instance to update
     * @return bool True if the update was successful, false otherwise
     */
    public function updateMovie(array $data ,$movie ) {
     
       return  $movie->update($data);
    }

     /**
     * Delete an existing movie record from the database
     *
     * @param \App\Models\Movie $movie The movie instance to delete
     * @return bool|null True if the deletion was successful, null otherwise
     */
    public function deleteMovie($movie) {
        return $movie->delete();
    }
  
  
}
