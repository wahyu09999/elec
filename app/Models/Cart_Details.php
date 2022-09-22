<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;














class Cart_Details extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table='cart_details'; 

    public function barang(){
        return $this->belongsTo(Barang::class);
    }

    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
