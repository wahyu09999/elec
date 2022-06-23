@extends('dashboard.main')

@section('title', 'Alamat')


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Alamat</h2>
    </div>
    
    <div class="container mt-5">
 
        <div class="row justify-content-center align-items-center">
            <div class="card">
                <div class="card-header">
                Edit Alamat
            </div>
            <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/store-edit-address/{{$data->id}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Nama Penerima</label>
                                <input type="text" class="form-control" name="nama_penerima" placeholder="Masukkan Nama Penerima" value="{{$data->nama_penerima}}" />
                                @error('nama_penerima')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Nomor HP</label>
                                <input type="text" class="form-control" name="no_tlp" placeholder="Masukkan Nomor HP" value="{{$data->no_tlp}}" />
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
                                <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" value="{{$data->alamat}}" />
                                @error('alamat')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kelurahan/Desa</label>
                                <input type="text" class="form-control" name="kelurahan" placeholder="Masukkan Kelurahan/Desa" value="{{$data->kelurahan}}" />
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
                                <input type="text" class="form-control" name="kecamatan" placeholder="Masukkan Kecamatan" value="{{$data->kecamatan}}" />
                                @error('kecamatan')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kabupaten/Kota</label>
                                <input type="text" class="form-control" name="kota" placeholder="Masukkan Kabupaten/Kota" value="{{$data->kota}}" />
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
                                <input type="text" class="form-control" name="provinsi" placeholder="Masukkan Provinsi" value="{{$data->provinsi}}" />
                                @error('provinsi')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kodepos</label>
                                <input type="number" class="form-control" name="kodepos" placeholder="Masukkan Kodepos" value="{{$data->kodepos}}" />
                                @error('kodepos')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tax-select-wrapper">
                                <div class="tax-select mb-0">
                                    <label>Status Alamat Pengiriman</label>
                                    <select class="form-control" name="status">
                                        @if($data->status == "Utama")
                                        <option value="Utama" selected>Utama</option>
                                        <option value="Opsional">Opsional</option>
                                        @else
                                        <option value="Utama">Utama</option>
                                        <option value="Opsional" selected>Opsional</option>
                                        @endif
                                    </select>
                                </div>
                                @error('status')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        </div>
        </div>
    </div>

@endsection
