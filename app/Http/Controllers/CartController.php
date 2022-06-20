<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cart;
use App\Models\Cart_Details;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function tambahCart(Request $request, $id){
        $barang = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        //cek validasi
        $cek_cart = Cart::where('user_id', Auth::user()-> id)->where('status', 0)->first();
       
        //simpan ke database cart
        if(empty($cek_cart)){
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            $cart->tanggal = $tanggal;
            $cart->status = 0;
            $cart->jumlah_harga = 0;
            $cart->save();
        }
       

        //simpan ke database cart_details
        $cart_details_new = Cart::where('user_id', Auth::user()-> id)->where('status', 0)->first();

        //cek cart details
        $cek_cart_details = Cart_Details::where('barang_id',$barang->id)->where('cart_id', $cart_details_new->id)->first();

        if(empty($cek_cart_details)){
            $cart_details = new Cart_Details;
            $cart_details->barang_id = $barang->id;
            $cart_details->cart_id = $cart_details_new->id;
            $cart_details->jumlah = $request->jumlah_pesan;
            $cart_details->jumlah_harga = $barang->harga * $request->jumlah_pesan;
            $cart_details->save();

        }else{
            $cart_details = Cart_Details::where('barang_id',$barang->id)->where('cart_id', $cart_details_new->id)->first();
            $cart_details->jumlah =  $cart_details->jumlah + $request->jumlah_pesan;
            
            //harga update
            $harga_cart_details = $barang->harga * $request->jumlah_pesan;
            $cart_details->jumlah_harga = $cart_details->jumlah_harga + $harga_cart_details;
            $cart_details->update();
        }

        //jumlah total
        $cart = Cart::where('user_id', Auth::user()-> id)->where('status', 0)->first();
        $cart->jumlah_harga = $cart->jumlah_harga + $barang->harga * $request->jumlah_pesan;
        $cart->update();

        return redirect('/cart-index');
    }

    public function index(){

        $data_cart_details = Cart_Details::with('barang')->with('cart')->get();

        return view('/dashboard/user/cart', ['data_cart_details' => $data_cart_details]);
    }

    public function deleteCart($id){
        $cart_details = Cart_Details::where('id', $id)->first();

        $cart = Cart::where('id', $cart_details->cart_id)->first();
        $cart->jumlah_harga = $cart->jumlah_harga - $cart_details->jumlah_harga;
        $cart->update();

        $cart_details->delete();
        
        return redirect('/cart-index');
    }

    public function checkout(){
      
        $cart = Cart::where('user_id', Auth::user()->id)->where('status',0)->first();
        $data_cart_details = Cart_Details::with('barang')->with('cart')->get();
        
        return view('/dashboard/user/checkout', ['data_cart_details' => $data_cart_details, 'cart'=>$cart]);
    }

    

}
