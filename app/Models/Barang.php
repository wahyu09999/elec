<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table='barang'; 

    protected $fillable =[
        'nama',
        'kategori_id',
        'harga',
        'stok',
        'deskripsi',
        'gambar',
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function cart_details(){
        return $this->hasMany(Cart_Details::class, 'cart_id');
    }
}
