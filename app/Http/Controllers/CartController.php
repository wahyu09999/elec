<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cart;
//use Auth;
use App\Models\Payment;
use App\Models\Cart_Details;
use App\Models\AlamatPengiriman;
use Illuminate\Support\Facades\Auth;
use PDF;

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
        $alamat = AlamatPengiriman::all();

        // return view('/dashboard/user/checkout', ['data_cart_details' => $data_cart_details, 'cart'=>$cart]);

        return view('/dashboard/user/checkout', ['data_cart_details' => $data_cart_details, 'cart'=>$cart, 'alamat' => $alamat]);
    }

    
    public function addAdress(Request $req)
    {
        $data = new AlamatPengiriman();
        $data->user_id = Auth::user()->id;
        $data->nama_penerima = $req->nama_penerima;
        $data->status = $req->status;
        $data->no_tlp = $req->no_tlp;
        $data->alamat = $req->alamat;
        $data->provinsi = $req->provinsi;
        $data->kota = $req->kota;
        $data->kecamatan = $req->kecamatan;
        $data->kelurahan = $req->kelurahan;
        $data->kodepos = $req->kodepos;
        $data->save();

        return redirect('/check-out');
    }

    public function editAddress($id)
    {
        $data = AlamatPengiriman::find($id);
        return view('/dashboard/user/edit_alamat', ['data' => $data]);
    }

    public function storeEditAddress(Request $req, $id)
    {
        $data = AlamatPengiriman::find($id);
        $data->user_id = Auth::user()->id;
        $data->nama_penerima = $req->nama_penerima;
        $data->status = $req->status;
        $data->no_tlp = $req->no_tlp;
        $data->alamat = $req->alamat;
        $data->provinsi = $req->provinsi;
        $data->kota = $req->kota;
        $data->kecamatan = $req->kecamatan;
        $data->kelurahan = $req->kelurahan;
        $data->kodepos = $req->kodepos;
        $data->save();

        return redirect('/check-out');
    }

    public function deleteAddress($id)
    {
        $data = AlamatPengiriman::find($id);
        $data->delete();

        return redirect('/check-out');
    }

    public function storePayment(Request $req, $id)
    {
        $cart = Cart::find($id);
        $data = new Payment();
        $data->user_id = Auth::user()->id;
        $data->cart_id = $id;
        $data->alamat_id = $req->alamat_pengiriman;
        $data->total = $cart->jumlah_harga;
        $data->no_invoice = Carbon::now()->toDateString() . "/" . rand(1000, 5000) . "/" . rand(10, 99);
        $data->status = 0;
        $image = $req->file('bukti');
        $imgName = $image->getClientOriginalName();
        $image->move(public_path('bukti'), $imgName);
        $data->bukti = $imgName;
        $data->save();

        $cd = Cart_Details::where('cart_id', $id)->get();
        $brg = Barang::all();
        foreach($brg as $item) {
            foreach($cd as $item2){
                if($item2->barang_id == $item->id){
                    $item->stok -= $item2->jumlah;
                    $item->save();
                }
            }
        }

        $cart->status = 1;
        $cart->save();

        return redirect("/riwayat-transaksi");
    }

    public function indexTransaction(Type $var = null)
    {
        $data = Payment::all();
        return view('dashboard/user/riwayatTransaksi', ['data' => $data]);
    }

    public function prinTransaction($id)
    {
        $data = Payment::find($id);
        $cartDetail = Cart_Details::where('cart_id', $data->cart_id)->get();
    
        $pdf = PDF::loadview('dashboard/user/cetak', ['data' => $data, 'cartDetail' => $cartDetail])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }



}
