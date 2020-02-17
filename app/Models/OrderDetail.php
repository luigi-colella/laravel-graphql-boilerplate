<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * Get the order record associated with the order detail.
     * 
     * @return HasOne
     */
    public function order(): HasOne
    {
        return $this->hasOne(Order::class, 'orderNumber', 'orderNumber');
    }

    /**
     * Get the product record associated with the order detail.
     * 
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'productCode', 'productCode');
    }
}
