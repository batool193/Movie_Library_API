<?php
namespace App\Services;

use App\Models\Movie;

class MovieService {

    public function createMovie(array $data) {
        return Movie::create($data);
    }
    public function updateMovie(array $data ,$id ) {
       return Movie::find($id)->updated($data); 
    }
    public function deleteMovie($id) {
        return Movie::find($id)->delete();
    }
  
  
}
