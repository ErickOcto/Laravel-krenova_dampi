@extends('admin.layouts.app')

@section('content')
<div class="main-content container-fluid">

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Data Pengguna</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Nama Pengguna</label>
                                            <input type="text" id="first-name-column" name="name" class="form-control" placeholder="Masukkan Nama Pengguna" value="{{ old('name', $user->name) }}">
                                        </div>
                                        @error('name')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Email</label>
                                            <input type="email" id="first-name-column" name="email" class="form-control" placeholder="Masukkan Alamat Email" value="{{ old('email', $user->email) }}">
                                        </div>
                                        @error('email')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Password</label>
                                            <input type="password" id="first-name-column" name="password" class="form-control" placeholder="Kosongkan Jika Tidak Ingin Mengubah Password">
                                        </div>
                                        @error('password')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">No KTP</label>
                                            <input type="text" id="first-name-column" name="ktp" class="form-control" placeholder="Masukkan No KTP" value="{{ old('ktp', $user->ktp) }}">
                                        </div>
                                        @error('ktp')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Pilih Role</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" name="role">
                                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Petugas</option>
                                                    <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Perusahaan</option>
                                                    <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Admin</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        @error('role')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Informasi Tambahan</label>
                                            <textarea id="first-name-column" name="address" class="form-control" placeholder="Masukkan Informasi Jika Ada">{{ $user->address }}</textarea>
                                        </div>
                                        @error('address')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <a href="{{ route('user.index') }}" class="btn btn-light-secondary me-1 mb-1">Kembali</a>
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
