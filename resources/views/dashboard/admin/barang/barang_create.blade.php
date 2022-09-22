@extends('dashboard.main')

@section('title', 'Barang')


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Barang</h2>
    </div>
    
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Tambah Barang
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        <!-- simpan ke fungsi store -->
        <form method="post" action="{{ route('barang.store') }}" id="myForm" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="nama">Nama Barang</label> 
                <input type="text" name="nama" class="form-control" id="nama" aria-describedby="nama" > 
            </div>
            <div class="form-group">
                <label for="kategori">Nama Kategori</label> 
                <select class="form-control" name="kategori">
                @foreach($data_barang_create as $ktgr)
                    <option value="{{$ktgr->id}}">{{$ktgr->nama_kategori}}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label> 
                <input type="harga" name="harga" class="form-control" id="harga" aria-describedby="harga" > 
            </div>
            <div class="form-group">
                <label for="stok">Stok</label> 
                <input type="stok" name="stok" class="form-control" id="stok" aria-describedby="stok" > 
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label> 
                <input type="deskripsi" name="deskripsi" class="form-control" id="deskripsi" aria-describedby="deskripsi" > 
            </div>
            <div class="form-group">
                <label for="foto">Foto</label> 
                <input type="file" name="foto" class="form-control" id="foto" aria-describedby="foto" > 
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
 </div>
@endsection