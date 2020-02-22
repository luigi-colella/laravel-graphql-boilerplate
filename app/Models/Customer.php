<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * Get the sales rep employee record associated with the customer.
     * 
     * @return HasOne
     */
    public function salesRepEmployee(): HasOne
    {
        return $this->hasOne(Employee::class, 'employeeNumber', 'salesRepEmployeeNumber');
    }

    /**
     * Get the order records associated with the customer.
     * 
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'customerNumber', 'customerNumber');
    }

    /**
     * Get the payment records associated with the customer.
     * 
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'customerNumber', 'customerNumber')->orderBy('checkNumber');
    }
}
