<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'customers';

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
        'customerName' => 'string',
        'contactLastName' => 'string',
        'contactFirstName' => 'string',
        'phone' => 'string',
        'addressLine1' => 'string',
        'addressLine2' => 'string',
        'city' => 'string',
        'state' => 'string',	
        'postalCode' => 'string',
        'country' => 'string',
        'salesRepEmployeeNumber' => 'integer',
        'creditLimit' => 'float',
    ];
}
