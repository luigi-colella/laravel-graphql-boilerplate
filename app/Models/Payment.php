<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'amount' => 'integer',
    ];
}
