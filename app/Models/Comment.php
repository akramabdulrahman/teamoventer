<?php

namespace App\Models;

use app\Models\Traits\CreatedByUser;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use CreatedByUser;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content','user_id'];


    public function commentable()
    {
        return $this->morphTo();
    }
}
