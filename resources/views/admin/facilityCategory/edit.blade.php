@extends('admin.layouts.app')

@section('content')
<div class="main-content container-fluid">

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Data Kategori</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('category-facility.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Nama Kategori</label>
                                            <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Nama Kategori"
                                                name="name" value="{{ old('name', $category->name) }}">
                                        </div>
                                    </div>
                                    @error('name')
                                        <strong class="alert alert-danger">{{ $message }}</strong>
                                    @enderror
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Ikon Kategori</label>
                                            <input type="file" id="last-name-column" class="form-control" placeholder="Last Name"
                                                name="iconUrl">
                                        </div>
                                    </div>
                                    @error('iconUrl')
                                        <strong class="alert alert-danger">{{ $message }}</strong>
                                    @enderror
                                    <div class="col-12 d-flex justify-content-end">
                                        <a href="{{ route('category-facility.index') }}" class="btn btn-light-secondary me-1 mb-1">Kembali</a>
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
