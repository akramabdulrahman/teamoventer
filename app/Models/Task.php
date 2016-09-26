<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function state_editor()
    {
        return $this->belongsTo(User::class);
    }


}
