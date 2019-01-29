<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Product extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'title', 'abstract', 'description', 'price', 'image_url', 'stock',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $model->id = Uuid::uuid1();
        });
    }
}
