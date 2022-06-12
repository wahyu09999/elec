@extends('dashboard.main')

@section('title', 'Kategori')


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Kategori</h2>
    </div>
    
    <div class="float-right my-2">
        <a class="btn btn-success" href="{{ route('kategori.create') }}"> Input Kategori</a>
        </div>
    <table class="table table-bordered">
        <tr>
            <th>Nomor</th>
            <th>Nama Kategori</th>

            <th width="300px">Action</th>
        </tr>
        @foreach ($data_kategori as $ktgr)
        <tr>
 
            <td>{{ $ktgr ->id }}</td>
            <td>{{ $ktgr ->nama_kategori }}</td>

            <td>
            <form action="{{ route('kategori.destroy',['kategori'=>$ktgr->id]) }}" method="POST">
                
                <a class="btn btn-info" href="{{ route('kategori.show',$ktgr->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('kategori.edit',$ktgr->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection