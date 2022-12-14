@extends('dashboard.main')

@section('title', 'Barang')


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Barang</h2>
    </div>
    
    <div class="float-right my-2">
        <!-- //untuk memanggil form create -->
        <a class="btn btn-success" href="{{ route('barang.create') }}"> Input Barang</a>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Nama Barang</th>
            <th>Nama Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Deskripsi</th>
            <th>Foto</th>

            <th width="300px">Action</th>
        </tr>
        @foreach ($data_barang as $brng)
        <tr>
 
            <td>{{ $brng ->nama }}</td>
            <td>{{ $brng ->kategori ->nama_kategori }}</td>
            <td>{{ $brng ->harga }}</td>
            <td>{{ $brng ->stok }}</td>
            <td>{{ $brng ->deskripsi }}</td>
            <td><img width="125px"
                src="{{'https://storage.googleapis.com/cloudwrz/'.$brng->gambar}}"></td> 
            <td>
                <!-- untuk menghapus data -->
            <form action="{{ route('barang.destroy',['barang'=>$brng->id]) }}" method="POST">
                <!-- untuk memanggilk fungsi show -->
                <a class="btn btn-info" href="{{ route('barang.show',$brng->id) }}">Show</a>
                <!-- untuk memanggil form edit -->
                <a class="btn btn-primary" href="{{ route('barang.edit',$brng->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection