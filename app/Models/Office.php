<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'offices';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'officeCode';

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
        'city' => 'string',
        'phone' => 'string',
        'addressLine1' => 'string',
        'addressLine2' => 'string',
        'state' => 'string',
        'country' => 'integer',
        'postalCode' => 'string',
        'territory' => 'string',
    ];
}
