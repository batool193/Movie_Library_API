<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'title',
        'director',
        'genre',
        'release_year',
       'description'];

       public function ratings(): HasMany
       {
           return $this->hasMany(Rating::class);
       }
       public function scopeByGenre($query,$genre) {
        return $query->where('genre', $genre);
     }
     public function scopeByDirector($query,$director) {
         return $query->where('director', $director);
     }
     public function scopeByReleaseYear($query,$sort_by) {
        return $query->orderBy('release_year', $sort_by);
    }
}
