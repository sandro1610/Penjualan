<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Produk extends Model
{
    use Prunable;
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
