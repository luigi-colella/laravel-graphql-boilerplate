<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'employees';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'employeeNumber';

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
        'lastName' => 'string',
        'firstName' => 'string',
        'extension' => 'string',
        'email' => 'string',
        'officeCode' => 'string',
        'reportsTo' => 'integer',
        'jobTitle' => 'string',
    ];

    /**
     * Get the customer records associated with the employee.
     * 
     * @return HasMany
     */
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'salesRepEmployeeNumber', 'employeeNumber');
    }

    /**
     * Get the employee record associated with this one.
     * 
     * @return HasOne
     */
    public function manager(): HasOne
    {
        return $this->hasOne(Employee::class, 'employeeNumber', 'reportsTo');
    }

    /**
     * Get the office record associated with the employee.
     * 
     * @return HasOne
     */
    public function office(): HasOne
    {
        return $this->hasOne(Office::class, 'officeCode', 'officeCode');
    }
}
