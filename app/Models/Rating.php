<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;

     /**
     * The attributes that should assign
     *
     * @var array
     */
    
    protected $fillable = ['user_id', 'movie_id','rating','review'];

    /**
 * Define a relationship method to associate  rating model with the User model
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
 * Define a relationship method to associate rating model with the Movie model
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
    public function Movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
