<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'orders';

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
        'orderDate' => 'date',
        'requiredDate' => 'date',
        'shippedDate' => 'date',
        'status' => 'string',
        'comments' => 'string',
        'customerNumber' => 'integer',
    ];

    /**
     * Get the order detail record associated with the order.
     * 
     * @return HasMany
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'orderNumber', 'orderNumber');
    }
}
