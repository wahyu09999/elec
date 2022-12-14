<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\URL;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //fungsi index untuk menampilkan barang yang sudah di inputkan
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

     //fungsi create untuk menambah data kategori
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
    //fungsi store untuk menyimpan data yang sudah dibuat di fungsi create
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'gambar'=> 'required',
        ]);
        $image_name = '';
        if ($request->file('gambar')) {
            $image_name = $request->file('gambar');
            // $image_name = $request->file('gambar')->store('images', 'public');
            $storage = new StorageClient([
                'keyFilePath' => public_path('key.json')
            ]);

            $bucketName = env('GOOGLE_CLOUD_BUCKET');
            $bucket = $storage->bucket($bucketName);

            //get filename with extension
            $filenamewithextension = pathinfo($request->file('gambar')->getClientOriginalName(), PATHINFO_FILENAME);
            // $filenamewithextension = $request->file('gambar')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('gambar')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . uniqid() . '.' . $extension;

            Storage::put('public/uploads/' . $filenametostore, fopen($request->file('gambar'), 'r+'));

            $filepath = storage_path('app/public/uploads/' . $filenametostore);

            $object = $bucket->upload(
                fopen($filepath, 'r'),
                [
                    'predefinedAcl' => 'publicRead'
                ]
            );

            // delete file from local disk
            Storage::delete('public/uploads/' . $filenametostore);
        }
        // if ($request->file('gambar')) {
        //     $image_name = $request->file('foto')->store('images', 'public');
        // }

        $data_barang_store = new Barang;
        $data_barang_store->nama = $request->get('nama');
        $data_barang_store->harga = $request->get('harga');
        $data_barang_store->stok = $request->get('stok');
        $data_barang_store->deskripsi = $request->get('deskripsi');
        $data_barang_store->foto = $filenametostore;

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
    //fungsi show untuk menampilkan data berdasarkan id kategori(spesifik)
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
    //fungsi edit untuk mengubah data
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
    //fungsi update untuk menyimpan berubahan data yang sudah di edit 
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'foto'=>'required',
        ]);
        $image_name = '';
        $data_barang_update = Barang::with('kategori')->where('id', $id)->first();
        $data_barang_update->nama = $request->get('nama');
        $data_barang_update->harga = $request->get('harga');
        $data_barang_update->stok = $request->get('stok');
        $data_barang_update->deskripsi = $request->get('deskripsi');

        $data_barang_update = Barang::where('id', $id)->first();
        $storage = new StorageClient();
        $bucketName = env('GOOGLE_CLOUD_BUCKET');
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->object($data_barang_update->foto);

        if(($request->file('foto') && $object != null)){
            $image_name = $request->file('foto');
            $object->delete();
            $filenamewithextension = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filenametostore = $filename . '_' . uniqid() . '.' . $extension;
            Storage::put('public/uploads/' . $filenametostore, fopen($request->file('foto'), 'r+'));
            $filepath = storage_path('app/public/uploads/' . $filenametostore);

            $object = $bucket->upload(
                fopen($filepath, 'r'),
                [
                    'predefinedAcl' => 'publicRead'
                ]
            );

            // delete file from local disk
            Storage::delete('public/uploads/' . $filenametostore);
        }

        // if ($request->file('foto')) {
        //     $image_name = $filenametostore;
        //     $data_barang_update = array_merge($data, array('foto' => $image_name));
        // }

        Barang::where('id', $id)->update($data_barang_update);

        $image_name = $request->file('foto')->store('image', 'public');
        $data_barang_update->foto = $image_name;

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
    //fungsi destroy untuk menghapus data berdasarkan parameter id
    public function destroy($id)
    {
        $barangs = Barang::all()->where('id', $id)->first();
        $storage = new StorageClient();

        $bucketName = env('GOOGLE_CLOUD_BUCKET');
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->object($barangs->foto);



        $object->delete();
        $barangs->delete($barangs);
        return redirect()->route('barang.index')
            -> with('success', 'Mahasiswa Berhasil Dihapus');
    }
}
