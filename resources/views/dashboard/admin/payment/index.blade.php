@extends('dashboard.main')

@section('title', 'Transaksi')


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Transaksi</h2>
    </div>
    <div class="float-right my-2 ">
        <a class="btn btn-success" href="{{ route('transaksi.create') }}"> Generate Laporan</a>
    </div>
    <table class="table table-bordered">
            <tr>
                <th>Nomor</th>
                <th>No. Invoice</th>
                <th>Nama User</th>
                <th>Total Pembelian</th>
                <th>Alamat</th>
                <th>Status Pembayaran</th>
                <th>Bukti Pembayaran</th>
                <th>Action</th>
            </tr>
            @foreach($data as $key => $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->no_invoice }}</td>
                <td>{{ $item->user->name }}</td>
                <td>Rp. {{ number_format($item->total) }}</td>
                <td>{{ $item->alamat->alamat }}</td>
                <td>{{ ($item->status == 1) ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' }}</td>
                <td><a class="btn btn-primary" href="{{ route('transaksi.show',$item->id) }}">Show Picture</a></td>
                <td>
                    @if($item->status == 0)
                    <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-success">Verifikasi</a>
                    @endif
                </td>
                </td>
            </tr>
            @endforeach
    </table>

@endsection
