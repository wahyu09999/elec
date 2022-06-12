<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_barang = Barang::with('kategori')->get();
        if (auth()->user()->role=='user') {
            return view('/dashboard/user/listproduk', ['data_barang' => $data_barang]);
        } else {
            return view('/dashboard/admin/barang/barang_index', ['data_barang' => $data_barang]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_barang_create = Kategori::all();
        return view('/dashboard/admin/barang/barang_create', ['data_barang_create' => $data_barang_create]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'foto'=> 'required',
        ]);

        if ($request->file('foto')) {
            $image_name = $request->file('foto')->store('images', 'public');
        }

        $data_barang_store = new Barang;
        $data_barang_store->nama = $request->get('nama');
        $data_barang_store->harga = $request->get('harga');
        $data_barang_store->stok = $request->get('stok');
        $data_barang_store->deskripsi = $request->get('deskripsi');
        $data_barang_store->gambar = $image_name;

        $data_kategori = new Kategori;
        $data_kategori->id = $request->get('kategori');

        $data_barang_store->kategori()->associate($data_kategori);
        $data_barang_store->save();

        return redirect()->route('barang.index')
        ->with('success', 'Barang Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data_barang_show = Barang::with('kategori')->where('id', $id)->first();
        return view('/dashboard/admin/barang/barang_show', ['data_barang_show' => $data_barang_show]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_barang_edit = Barang::with('kategori')->where('id', $id)->first();
        $kategori = Kategori::all();
        return view('/dashboard/admin/barang/barang_edit', compact('data_barang_edit', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'foto'=>'required',
        ]);

        $data_barang_update = Barang::with('kategori')->where('id', $id)->first();
        $data_barang_update->nama = $request->get('nama');
        $data_barang_update->harga = $request->get('harga');
        $data_barang_update->stok = $request->get('stok');
        $data_barang_update->deskripsi = $request->get('deskripsi');
        if($data_barang_update->gambar && file_exists(storage_path('./app/public/'. $data_barang_update->gambar))){
            Storage::delete(['./public/',  $data_barang_update->gambar]);
        }
        $image_name = $request->file('foto')->store('image', 'public');
        $data_barang_update->gambar = $image_name;

        $kategori = new Kategori();
        $kategori->id = $request->get('kategori');
        
        $data_barang_update->kategori()->associate($kategori);
        $data_barang_update->save();
        
        return redirect()->route('barang.index')
            ->with('success', 'Barang Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Barang::where('id', $id)->delete();
        return redirect()->route('barang.index')
            -> with('success', 'Mahasiswa Berhasil Dihapus');
    }
}
