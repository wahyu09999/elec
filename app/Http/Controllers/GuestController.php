<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;

class GuestController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        
        return view('guest/listproduk', ['barang' => $barang]);
    }

}
