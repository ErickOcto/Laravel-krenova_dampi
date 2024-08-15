@extends('admin.layouts.app')

@section('content')
<div class="main-content container-fluid">

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data Projek</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Nama Pekerjaan</label>
                                            <input type="text" id="first-name-column" name="name" class="form-control" placeholder="Masukkan Nama Pekerjaan">
                                        </div>
                                        @error('name')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Pilih Perusahaan</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" name="company_id">
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                        @error('company_id')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Latitude</label>
                                            <input type="text" id="first-name-column" name="lat" class="form-control" placeholder="Masukkan Latitude">
                                        </div>
                                        @error('lat')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Longtitude</label>
                                            <input type="text" id="first-name-column" name="long" class="form-control" placeholder="Masukkan Longtitude">
                                        </div>
                                        @error('long')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Mulai</label>
                                            <input type="date" id="first-name-column" name="p_start" class="form-control" placeholder="Masukkan Tanggal Mulai">
                                        </div>
                                        @error('p_start')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Selesai</label>
                                            <input type="date" id="first-name-column" name="p_end" class="form-control" placeholder="Masukkan Tanggal Mulai">
                                        </div>
                                        @error('p_end')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Gambar Pekerjaan</label>
                                            <input type="file" accept=".jpg, .png, .jpeg, .svg" id="first-name-column" name="imageUrl" class="form-control" placeholder="Masukkan Gambar Fasilitas">
                                        </div>
                                        @error('imageUrl')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Biaya</label>
                                            <input type="number" id="first-name-column" min="1" name="cost" class="form-control" placeholder="Masukkan Biaya ">
                                        </div>
                                        @error('cost')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Deskripsi Pekerjaan</label>
                                            <textarea id="first-name-column" name="description" class="form-control" placeholder="Masukkan Deskripsi Pekerjaan" rows="5"></textarea>
                                        </div>
                                        @error('description')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Alamat Pekerjaan</label>
                                            <textarea id="first-name-column" name="address" class="form-control" placeholder="Masukkan Alamat Pekerjaan" rows="5"></textarea>
                                        </div>
                                        @error('address')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <a href="{{ route('project.index') }}" class="btn btn-light-secondary me-1 mb-1">Kembali</a>
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
