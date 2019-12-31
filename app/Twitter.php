<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Twitter extends Model
{
    protected $table = "twitters";
    
    
    public function users()
    {
        return $this->hasOne('App\User');
    }
}
