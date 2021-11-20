<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Products extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'product_name',
        'description',
        'style',
        'brand',
        'url',
        'product_type',
        'shipping_price',
        'note',
        'admin_id',
    ];

    /**
     * The products inventory
     * 
     * @return HasMany
     */
    public function inventory() : HasMany
    {
        return $this->hasMany(Inventory::class, 'product_id', 'id');
    }

}
