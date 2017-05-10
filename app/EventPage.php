<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventPage extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
