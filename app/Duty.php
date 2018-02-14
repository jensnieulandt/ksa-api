<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Duty extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'role_id'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function duty()
    {
        return $this->belongsTo('App\Role');
    }
}
