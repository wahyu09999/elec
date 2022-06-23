@extends('dashboard.main')

@section('title', 'Riwayat Transaksi')


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Riwayat Transaksi</h2>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Nomor</th>
            <th>No. Invoice</th>
            <th>Nama User</th>
            <th>Total Pembelian</th>
            <th>Alamat</th>
            <th>Status Pembayaran</th>
            <th>Action</th>

        </tr>
        <?php $no = 1; ?>
        @foreach ($data as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item->no_invoice }}</td>
            <td>{{ $item->user->name }}</td>
            <td>Rp. {{ number_format($item->total) }}</td>
            <td>{{ $item->alamat->alamat }}</td>
            <td>{{ ($item->status == 1) ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' }}</td>
            <td>
            <a href="/cetak-transaksi/{{$item->id}}" class="btn btn-success">Cetak</a>
            </td>
        </tr>
        @endforeach
    </table>



@endsection