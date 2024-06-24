<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penerbit extends Model
{
    protected $table    ="penerbit";
    protected $fillable =  [
        'id_penerbit','nama','alamat','kota','telepon'
    ];

    public static function orderByStockAsc()
    {
        return static::orderBy('stok', 'asc')->get();
    }
    
}

