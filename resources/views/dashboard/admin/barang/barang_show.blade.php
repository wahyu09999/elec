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
                Detail Barang
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Nama Barang  : </b>{{$data_barang_show->nama}}</li>
                        <li class="list-group-item"><b>Nama Kategori: </b>{{$data_barang_show->kategori->nama_kategori}}</li>
                        <li class="list-group-item"><b>Harga        : </b>{{$data_barang_show->harga}}</li>
                        <li class="list-group-item"><b>Stok         : </b>{{$data_barang_show->stok}}</li>
                        <li class="list-group-item"><b>Deskripsi    : </b>{{$data_barang_show->deskripsi}}</li>
                        <li class="list-group-item"> <img width="150px" src="{{asset('storage/'.$data_barang_show->gambar)}}"></li>
                    </ul>
                </div><br>
                <a class="btn btn-success mt-3" href="{{ route('barang.index') }}">Kembali</a>
            </div>
        </div>
     </div>

@endsection