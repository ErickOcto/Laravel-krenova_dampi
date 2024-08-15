@extends('admin.layouts.app')

@section('content')
<div class="main-content container-fluid">

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Data Perusahaan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Nama Perusahaan</label>
                                            <input type="text" id="first-name-column" name="name" class="form-control" value="{{ old('name', $company->name) }}" placeholder="Masukkan Nama Perusahaan">
                                        </div>
                                        @error('name')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Nama Pemilik</label>
                                            <input type="text" id="first-name-column" name="owner" class="form-control" value="{{ old('owner', $company->owner) }}" placeholder="Masukkan Nama Pemilik">
                                        </div>
                                        @error('owner')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Latitude</label>
                                            <input type="text" id="first-name-column" name="lat" class="form-control" value="{{ old('lat', $company->lat) }}" placeholder="Masukkan Latitude">
                                        </div>
                                        @error('lat')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Longtitude</label>
                                            <input type="text" id="first-name-column" name="long" class="form-control" value="{{ old('long', $company->long) }}" placeholder="Masukkan Longtitude">
                                        </div>
                                        @error('long')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Telepon</label>
                                            <input type="text" id="first-name-column" name="phone" class="form-control" value="{{ old('phone', $company->phone) }}" placeholder="Masukkan Longtitude">
                                        </div>
                                        @error('phone')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Gambar Fasilitas</label>
                                            <input type="file" accept=".jpg, .png, .jpeg, .svg" id="first-name-column" name="imageUrl" class="form-control" placeholder="Masukkan Gambar Fasilitas">
                                        </div>
                                        @error('imageUrl')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Alamat / Deskripsi</label>
                                            <textarea id="first-name-column" name="description" class="form-control" placeholder="Masukkan Deskripsi Fasilitas" rows="5">{{ $company->description }}</textarea>
                                        </div>
                                        @error('description')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <a href="{{ route('company.index') }}" class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>
@endsection
