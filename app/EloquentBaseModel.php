<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EloquentBaseModel extends Model
{
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (count($model->forcedNullFields) > 0) {
                foreach ($model->toArray() as $fieldName => $fieldValue) {
                    if (empty($fieldValue) && in_array($fieldName, $model->forcedNullFields)) {
                        $model->attributes[$fieldName] = null;
                    }
                }
            }

            return true;
        });

    }
}
