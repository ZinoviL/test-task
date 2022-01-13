<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder;

/**
 * @mixin Builder
 */
class Film extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'genre_id',
    ];

    /**
     * Get actors for this film.
     */
    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'film_actors');
    }

    /**
     * Get genre for this film.
     */
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
