@extends('dashboard.main')
@section('title', 'Check Out')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Check Out</h2>
    </div>

    <div class="checkout-section mt-50 mb-150">
		<div class="container" style="margin-left: -10px">
			<div class="row">
				
				<div class="col-md-8 mb-4">
                <div class="cart-tax">
                    <br>
                    <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#tambahAlamatPengirimanModal">
                        Tambah Alamat Pengiriman
                    </button>
                    <div class="title-wrap">
                        <h4 class="cart-bottom-title section-bg-gray">Data Alamat Pengiriman</h4>
                    </div>
                    <div class="tax-wrapper">
                        <div class="table-content table-responsive cart-table-content">
                            <table class="w-100">
                                <thead>
                                    <tr>
                                        <th>Nama Penerima</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

				<div class="col-lg-4">
					<div class="order-details-wrap">
						<table class="order-details">
							<thead>
								<tr>
									<th>Your order Details</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody class="order-details-body">
								<tr>
									<td>Product</td>
									<td>Total</td>
								</tr>
								

								
							</tbody>
							<tbody class="checkout-details">
								
								
								<tr>
									<td>Total</td>
                                   
								</tr>
							</tbody>
						</table>
						<a href="#" type="submit" form="finalize" class="boxed-btn" value="Place Order"></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="tambahAlamatPengirimanModal" tabindex="-1" role="dialog" aria-labelledby="tambahAlamatPengirimanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahAlamatPengirimanModalLabel">Tambah Alamat Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Nama Penerima</label>
                                <input type="text" class="px-2 @error('nama_penerima') border-danger @enderror" name="nama_penerima" placeholder="Masukkan Nama Penerima" value="{{old('nama_penerima')}}" />
                                @error('nama_penerima')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Nomor HP</label>
                                <input type="text" class="px-2 @error('no_tlp') border-danger @enderror" name="no_tlp" placeholder="Masukkan Nomor HP" value="{{old('no_tlp')}}" />
                                @error('no_tlp')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Alamat</label>
                                <br>
                                <input type="text" class="px-2 @error('alamat') border-danger @enderror" name="alamat" placeholder="Masukkan Alamat" value="{{old('alamat')}}" />
                                @error('alamat')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kelurahan/Desa</label>
                                <input type="text" class="px-2 @error('kelurahan') border-danger @enderror" name="kelurahan" placeholder="Masukkan Kelurahan/Desa" value="{{old('kelurahan')}}" />
                                @error('kelurahan')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kecamatan</label>
                                <input type="text" class="px-2 @error('kecamatan') border-danger @enderror" name="kecamatan" placeholder="Masukkan Kecamatan" value="{{old('kecamatan')}}" />
                                @error('kecamatan')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kabupaten/Kota</label>
                                <input type="text" class="px-2 @error('kota') border-danger @enderror" name="kota" placeholder="Masukkan Kabupaten/Kota" value="{{old('kota')}}" />
                                @error('kota')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Provinsi</label>
                                <br>
                                <input type="text" class="px-2 @error('provinsi') border-danger @enderror" name="provinsi" placeholder="Masukkan Provinsi" value="{{old('provinsi')}}" />
                                @error('provinsi')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kodepos</label>
                                <input type="number" class="px-2 @error('kodepos') border-danger @enderror" name="kodepos" placeholder="Masukkan Kodepos" value="{{old('kodepos')}}" />
                                @error('kodepos')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select-wrapper">
                                <div class="tax-select mb-0">
                                    <label>Status Alamat Pengiriman</label>
                                    <select class="email s-email s-wid @error('status') border-danger @enderror" name="status">
                                        <option disabled selected hidden>-- Pilih status alamat pengiriman --</option>
                                        <option value="1">Utama</option>
                                        <option value="0">Opsional</option>
                                    </select>
                                </div>
                                @error('status')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editAlamatPengirimanModal" tabindex="-1" role="dialog" aria-labelledby="editAlamatPengirimanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAlamatPengirimanModalLabel">Edit Alamat Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body-edit-alamat"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editAlamatPengirimanModal" tabindex="-1" role="dialog" aria-labelledby="editAlamatPengirimanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAlamatPengirimanModalLabel">Edit Alamat Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body-edit-alamat"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editAlamatProdukModal" tabindex="-1" role="dialog" aria-labelledby="editAlamatProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAlamatProdukModalLabel">Edit Alamat Pengiriman Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body-edit-alamat-produk"></div>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection