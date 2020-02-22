<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'payments';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'customerNumber';

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
        'checkNumber' => 'string',
        'paymentDate' => 'date',
        'amount' => 'float',
    ];

    /**
     * Get the product record associated with the order detail.
     * 
     * @return HasOne
     */
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'customerNumber', 'customerNumber');
    }
}
