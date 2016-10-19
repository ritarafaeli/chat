<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function message(){
        return $this->hasMany('\App\Message');
    }
}
