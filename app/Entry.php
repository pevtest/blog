<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Collective\Html\Eloquent\FormAccessible;

class Entry extends Model
{
    protected $table = "entries";
    
    
    public function users()
    {
        return $this->hasOne('App\User');
    }
}
