<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'group_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'mobile_phone',
        'profile_picture',
    ];
    protected $forcedNullFields = [
        'mobile_phone',
        'profile_picture',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function duties()
    {
        return $this->belongsToMany('App\Duty');
    }

    /**
     * gives duplicate entries, even with distinct
     * @return mixed
     */
    public function role()
    {
        return $this->duties()
            ->join('roles', 'duties.role_id', '=', 'roles.id')
            ->select('roles.*')
            ->orderBy('id', 'desc')
            ->limit(1);
    }
}
