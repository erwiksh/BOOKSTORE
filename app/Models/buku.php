<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class buku extends Model
{
    protected $table = "buku";
    protected $fillable =  [
        'id_buku','kategori','nama','harga','stok', 'penerbit_id'
    ];
    
    public function penerbit():BelongsTo
    {
        return $this->belongsTo('App\Models\penerbit', 'penerbit_id', 'id');
    }

    public static function orderByStockAsc()
    {
        return static::orderBy('stok', 'asc')->get();
    }
}
