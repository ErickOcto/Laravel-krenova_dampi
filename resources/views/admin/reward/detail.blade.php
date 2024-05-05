@extends('admin.layouts.app')

@push('add-styles')
    <link rel="stylesheet" href="/template/assets/vendors/simple-datatables/style.css">
@endpush
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Penghargaan {{ $facility->name }}</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <form action="{{ route('reward.create') }}" method="POST" class="row m-2">
                @csrf
                <input type="hidden" name="facility_id" value="{{ $facility->id }}">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="first-name-column">Pilih Penghargaan</label>
                        <fieldset class="form-group">
                            <select class="form-select" name="reward_category_id">
                                @foreach ($awardCat as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </fieldset>
                    </div>
                    @error('reward_category_id')
                        <strong class="alert alert-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="first-name-column">Deskripsi Singkat</label>
                        <input type="text" id="first-name-column" name="description" class="form-control" placeholder="Masukkan deskripsi" required>
                    </div>
                    @error('description')
                        <strong class="alert alert-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="col-md-3 d-grid">
                    <button class="btn btn-primary">
                        Tambahkan
                    </button>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="card-header">
                Daftar Fasilitas yang ada di sistem
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori Penghargaan</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($awards as $award)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $award->reward_category_name }}
                            </td>
                            <td>
                                {{ $award->description }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection

@push('add-scripts')
    <script src="/template/assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="/template/assets/js/vendors.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');

        @endif
    </script>
@endpush
