<?php

namespace App\Models;

use App\Models\Traits\CreatedByUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use CreatedByUser;

    protected $fillable = ['url', 'user_id','lat','lng'];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }

    public function ScopeDistance($query, $from_latitude, $from_longitude, $distance)
    {
        // This will calculate the distance in km
        // if you want in miles use 3959 instead of 6371
        $raw = \DB::raw('ROUND ( ( 6371 * acos( cos( radians(' . $from_latitude . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $from_longitude . ') ) + sin( radians(' . $from_latitude . ') ) * sin( radians( lat ) ) ) ) ) AS distance');
        return $query->select('*')->addSelect($raw)->orderBy('distance', 'ASC')->limit(20);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('comments', function (Builder $builder) {
            $builder->with('user');
            $builder->with('comments');
            $builder->with('likes');
        });
    }
}
