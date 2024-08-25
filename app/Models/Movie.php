<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that should assign
     *
     * @var array
     */
    protected $fillable = [ 
        'title',
        'director',
        'genre',
        'release_year',
       'description'];

          /**
     * Get the ratings for the movie
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
       public function ratings(): HasMany
       {
           return $this->hasMany(Rating::class);
       }

           /**
     * Scope a query to only include movies of a given genre
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $genre
     * @return \Illuminate\Database\Eloquent\Builder
     */
       public function scopeByGenre($query,$genre) {
        return $query->where('genre', $genre);
     }

      /**
     * Scope a query to only include movies by a given director
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $director
     * @return \Illuminate\Database\Eloquent\Builder
     */
     public function scopeByDirector($query,$director) {
         return $query->where('director', $director);
     }

      /**
     * Scope a query to order movies by release year
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $sort_by
     * @return \Illuminate\Database\Eloquent\Builder
     */
     public function scopeByReleaseYear($query,$sort_by) {
        return $query->orderBy('release_year', $sort_by);
    }
}
