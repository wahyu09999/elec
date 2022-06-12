<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable =[
        'nama',
        'harga',
        'stok',
        'deskripsi',
        'gambar',
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
