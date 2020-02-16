<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'products';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'productCode';

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
        'productName' => 'string',
        'productLine' => 'string',
        'productScale' => 'string',
        'productVendor' => 'string',
        'productDescription' => 'string',
        'quantityInStock' => 'integer',
        'buyPrice' => 'integer',
        'MSRP' => 'integer',
    ];
}
