@extends('admin.layouts.app')

@push('add-styles')
    <link rel="stylesheet" href="/template/assets/vendors/simple-datatables/style.css">
@endpush
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Kategori Fasilitas</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-1 order-first">
                <div class="text-end">
                    <a href="{{ route('facility.create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Daftar Fasilitas yang ada di sistem
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facilities as $facility)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $facility->name }}
                            </td>
                            <td>
                                <img src="{{ asset('/storage/facilities/'.$facility->imageUrl) }}" alt="{{ $facility->imageUrl }}" class="rounded" style="width: 150px">
                            </td>
                            <td>
                                <div class="badge bg-success">
                                    {{ $facility->category_name }}
                                </div>
                            </td>
                            <td>
                                {{ $facility->description }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center grid gap-2">
                                    <a href="{{ route('facility.edit', $facility->id) }}" class="btn btn-warning">
                                        Edit
                                    </a>
                                    <form onsubmit="return confirm('Apakah anda yakin?')" action="{{ route('facility.destroy', $facility->id) }}" method="POST">
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
