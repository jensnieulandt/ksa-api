<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactPerson extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function members()
    {
        return $this->belongsToMany('App\Member');
    }

    public function phones()
    {
        return $this->hasMany('App\Phone');
    }

    public function mobilePhones()
    {
        return $this->hasMany('App\MobilePhone');
    }

    public function emailAddresses()
    {
        return $this->hasMany('App\EmailAddress');
    }
}
