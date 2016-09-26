<?php

namespace App\Models;

use App\Models\Traits\CreatedByUser;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use CreatedByUser;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'user_id'];


    public function likable()
    {
        return $this->morphTo();
    }
}
