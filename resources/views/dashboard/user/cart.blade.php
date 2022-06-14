@extends('dashboard.main')

@section('title', 'Cart')


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Cart</h2>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga</th>

        </tr>
        @foreach ($data_cart_details as $crt)
        <tr>
 
            <td>{{ $crt ->barang->nama }}</td>
            <td>{{ $crt ->jumlah }}</td>
            <td>{{ $crt ->jumlah_harga }}</td>

            </td>
        </tr>
        @endforeach
    </table>
    
@endsection