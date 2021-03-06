<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobilePhone extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function contactPerson()
    {
        return $this->hasOne('App\ContactPerson');
    }
}
