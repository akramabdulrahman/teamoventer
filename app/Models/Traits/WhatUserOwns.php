<?php
/**
 * Created by PhpStorm.
 * User: akram
 * Date: 9/10/2016
 * Time: 4:45 PM
 */

namespace App\Models\Traits;


use App\Models\Like;
use App\Models\Comment;
use App\Models\Photo;

trait WhatUserOwns
{
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}