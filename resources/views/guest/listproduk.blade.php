@extends('layouts.guestLayout')


@section('content')
     <!-- ======= Product Section ======= -->
     <br><br>
     <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>List Produk</h2>
            <p>MACAM LIST PRODUK ELEKTRONIK</p>
          </div>
  
          <div class="row">


          @foreach($barang as $item)
            <div class="col-lg-6">
              <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                <div class="pic"><img src="{{ asset('storage/'.$item->gambar) }}" class="img-fluid" alt=""></div>
                <div class="member-info">
                  
                <h4>{{ $item->nama }}</h4>
                  <span>{{ $item->kategori->nama_kategori }}</span>
                  <p>{{ $item->deskripsi }}</p>
                  <p>Rp. {{ number_format($item->harga) }}</p>
                  
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </section><!-- End Team Section -->
      @include('guest/footer')
@endsection