<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'description'];

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function members()
    {
        return $this->hasMany('App\Member');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
