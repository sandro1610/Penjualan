<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = "produks";

    protected $guarded = [];

    /**
     * Get all of the Penjualan for the Produk
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Penjualan(): HasMany
    {
        return $this->hasMany('App\Penjualan', 'produk_id', 'id');
    }
}
