@extends('dashboard.main')

@section('title', 'Barang')


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Barang</h2>
    </div>
    
    <div class="container mt-5">
 
        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                Edit Barang
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
        <!-- untuk menyimpan data edit -->
        <form method="post" action="{{ route('barang.update', $data_barang_edit->id) }}" id="myForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama">Nama Barang</label> 
            <input type="text" name="nama" class="form-control" id="nama" value="{{ $data_barang_edit->nama }}" aria-describedby="nama" > 
        </div>
        <div class="form-group">
            <label for="kategori">Nama Kategori</label>
            <select class="form-control" name="kategori">
            @foreach($kategori as $ktgr)
                <option value="{{$ktgr->id}}" {{ $data_barang_edit->kategori_id == $ktgr->id ? 'selected' : ''}}>{{$ktgr->nama_kategori}}</option>
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label> 
            <input type="text" name="harga" class="form-control" id="harga" value="{{ $data_barang_edit->harga }}" aria-describedby="harga" > 
        </div>
        <div class="form-group">
            <label for="stok">Stok</label> 
            <input type="stok" name="stok" class="form-control" id="stok" value="{{ $data_barang_edit->stok }}" aria-describedby="stok" > 
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label> 
            <input type="deskripsi" name="deskripsi" class="form-control" id="deskripsi" value="{{ $data_barang_edit->stok }}" aria-describedby="deskripsi" > 
        </div>
        <div class="form-group"> 
            <label for="foto">Foto</label> 
            <input type="file" class="form-control" name="foto" id="foto" value="{{$data_barang_edit->gambar}}"></br> 
                <img width="250px" src="{{asset('storage/'.$data_barang_edit->gambar)}}"> 
        </div> 
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        </div>
        </div>
    </div>

@endsection