@extends('dashboard.main')

@section('title', 'List Produk')


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>List Produk</h2>
    </div>
    
    <!-- Default Card -->


    <!-- Card with header and footer -->

    <!-- Card with an image on left -->
    @foreach ($data_barang as $isi)
    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{asset('storage/'.$isi->gambar)}}"
                        style="object-fit:cover; background-size:cover; width:100%;" class="rounded-start"
                        alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-header">
                        <h4><span class="badge bg-warning text-dark">{{$isi->nama}}</span></h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><span class="text-info"><i class="ri-bookmark-2-line"></i>
                                {{$isi->kategori()->first()->nama_kategori}}</span> /
                            <span class="text-danger"> <i class="bi bi-person"></i> {{$isi->harga}}</span> /
                            <span class="text-primary"><i class="bi bi-book-half"></i> {{$isi->deskripsi}}</span>
                        </p>
                        <p>Jumlah Stok : {{$isi->stok}}
                        </p>

                        <form method="POST" action="{{ url('cart') }}/{{ $isi->id }}" >
                        @csrf
                        <input type="text" name="jumlah_pesan" class="form-control" placeholder="Masukkan Jumlah Pesanan">
                        <div class="card-text">
                            @if ($isi->stok > 0)
                            <button class="btn btn-success mt-3">Beli </button>
                            @endif
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- End Card with an image on left -->
    </div>
    {{-- Modal Delete --}}

    @endforeach

@endsection
