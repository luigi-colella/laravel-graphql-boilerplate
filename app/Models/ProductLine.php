<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLine extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'productlines';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'productLine';

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be casted to native types.
     * 
     * @var array
     */
    protected $casts = [
        'textDescription' => 'string',
        'htmlDescription' => 'string',
    ];
}
