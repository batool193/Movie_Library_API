<?php
namespace App\Services;

use App\Models\Rating;

class RatingService {

    
     /**
     * Create a new rating record in the database
     *
     * @param array $data The data to create the rating with
     * @return \App\Models\Rating The created rating instance
     */
    public function createRating(array $data) {
        return Rating::create($data);
    }
  
  
  
}
