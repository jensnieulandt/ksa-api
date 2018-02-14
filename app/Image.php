<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends EloquentBaseModel
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['event_id', 'caption', 'alt', 'path'];
    protected $forcedNullFields = ['caption', 'alt'];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
