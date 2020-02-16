<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'orderdetails';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'orderNumber';

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
        'productCode' => 'string',
        'quantityOrdered' => 'integer',
        'priceEach' => 'float',
        'orderLineNumber' => 'integer',
    ];
}
