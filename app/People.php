<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'peoples';



    public function group()
    {
        return $this->hasOne('App\Group', 'foreign_key', 'group_id');
    }
}
