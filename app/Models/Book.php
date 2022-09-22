<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $with = ['comments', 'authors'];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Retrieve books with ealier release date
     *
     * @return void
     */
    public function scopeEarlierReleased($query)
    {
        $query->orderBy('release_date');
    }
}
