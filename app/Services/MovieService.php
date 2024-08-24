<?php
namespace App\Services;

use App\Models\Movie;

class MovieService {

    public function createMovie(array $data) {
        return Movie::create($data);
    }
    public function updateMovie(array $data ,$movie ) {
     
       return  $movie->update($data);
    }
    public function deleteMovie($movie) {
        return $movie->delete();
    }
  
  
}
