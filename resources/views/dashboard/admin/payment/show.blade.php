@extends('dashboard.main')

@section('title', 'Transaksi')


@section('content')
<div class="container mt-5">
 
    <div class="row justify-content-center align-items-center">
        <div class="card">
            <div class="card-header">
            Detail Transaksi
            </div>
            <div class="card-body">
                <img src="{{ asset('bukti/'. $data->bukti) }}" alt="" srcset="">
            </div><br>
            <a class="btn btn-success mt-3" href="{{ route('transaksi.index') }}">Kembali</a>
        </div>
    </div>
 </div>

@endsection
