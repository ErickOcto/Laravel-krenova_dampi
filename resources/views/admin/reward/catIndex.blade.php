@extends('admin.layouts.app')

@push('add-styles')
    <link rel="stylesheet" href="/template/assets/vendors/simple-datatables/style.css">
@endpush
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Kategori Penghargaan</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <form action="{{ route('rewardCategory.create') }}" method="POST" class="row m-2">
                @csrf
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="first-name-column">Nama Kategori</label>
                        <input type="text" id="first-name-column" name="name" class="form-control" placeholder="Masukkan Nama Kategori" required>
                    </div>
                    @error('name')
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
                Daftar Kategori Penghargaan yang ada di sistem
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori Penghargaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rewards as $reward)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $reward->name }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center grid gap-2">
                                    <form onsubmit="return confirm('Apakah anda yakin?')" action="{{ route('rewardCategory.delete', $reward->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
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
