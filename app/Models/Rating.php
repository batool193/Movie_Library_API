<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;
    
    protected $fillable = ['rating','review'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function Movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
