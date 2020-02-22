<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductLine extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'productlines';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'productLine';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

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
        'textDescription' => 'string',
        'htmlDescription' => 'string',
    ];

    /**
     * Get the products record associated with the product line.
     * 
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'productLine', 'productLine');
    }
}
