<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'description', 'start'];

    public function duties()
    {
        return $this->hasMany('App\Duty');
    }

    public function users()
    {
        return $this->duties()
            ->join('duty_user', 'duty_user.duty_id', '=', 'duties.id')
            ->join('users', 'users.id', '=', 'duty_user.user_id')
            ->select('users.*')
            ->distinct();
    }
}
