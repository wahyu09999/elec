<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kategori = Kategori::all();

        return view('dashboard/admin/kategori/kategori_index', ['data_kategori' => $data_kategori]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_kategori_create = Kategori::all();
        return view('dashboard/admin/kategori/kategori_create', ['data_kategori_create' => $data_kategori_create]);
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
            'nama_kategori' => 'required',
        ]);

        $data_kategori_store = new Kategori;
        $data_kategori_store->nama_kategori = $request->get('nama_kategori');

        $data_kategori_store->save();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data_kategori_show = Kategori::where('id', $id)->first();
        return view('dashboard/admin/kategori/kategori_show', ['data_kategori_show' => $data_kategori_show]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_kategori_edit = Kategori::where('id', $id)->first();
        return view('dashboard/admin/kategori/kategori_edit', ['data_kategori_edit' => $data_kategori_edit]);
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
            'nama_kategori' => 'required',
        ]);

        $data_kategori_update = Kategori::where('id', $id)->first();
        $data_kategori_update->nama_kategori = $request->get('nama_kategori');

        $data_kategori_update->save();

        return redirect()->route('kategori.index')
        ->with('success', 'Kategori Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kategori::where('id', $id)->delete();
        return redirect()->route('kategori.index')
            -> with('success', 'Kategori Berhasil Dihapus');
    }
}
