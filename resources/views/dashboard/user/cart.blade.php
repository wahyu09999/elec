@extends('dashboard.main')

@section('title', 'Cart')


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Cart</h2>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Nomor</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga</th>
            <th>Jumlah Harga</th>
            <th>Action</th>

        </tr>
        <?php $no = 1; ?>
        @foreach ($data_cart_details as $crt)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $crt ->barang->nama }}</td>
            <td>{{ $crt ->jumlah }}</td>
            <td>Rp. {{ number_format($crt ->barang->harga) }}</td>
            <td>Rp. {{ number_format($crt ->jumlah_harga) }}</td>
            <td>
            <form action="{{ url('cart-delete')}}/{{ $crt->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="float-right">
        <a href="{{ url('check-out')}}" class="btn btn-success">
            <i data-feather = "shopping-cart"></i> Konfirmasi Cart
        </a>
    </div>    
@endsection