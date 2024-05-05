@extends('admin.layouts.app')

@push('add-styles')
    <link rel="stylesheet" href="/template/assets/vendors/simple-datatables/style.css">
@endpush
@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pendataan Kemiskinan</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <div class="text-end">
                        <a href="{{ route('poverty.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    Daftar Penduduk Miskin
                </div>
                <div class="card-body">
                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Pekerjaan</th>
                                <th>Status Kemiskinan</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($poverty as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>
                                        @if($data->gender === 'male')
                                            Laki-Laki
                                        @elseif($data->gender === 'female')
                                            Perempuan
                                        @else
                                            Tidak Terdefinisi
                                        @endif
                                    </td>                                    <td>{{ $data->economy->job_category ?? '' }}</td>
                                    @php
                                        $poverty_status = $data->economy->poverty_status;

                                        // Mengatur kelas dan teks badge berdasarkan status kemiskinan
                                        if ($poverty_status == 0) {
                                            $class = 'bg-success'; // hijau
                                            $text = 'Biasa'; // teks standar
                                        } elseif ($poverty_status == 1) {
                                            $class = 'bg-warning'; // kuning
                                            $text = 'Menengah'; // teks sedang
                                        } elseif ($poverty_status == 2) {
                                            $class = 'bg-danger'; // merah
                                            $text = 'Tinggi'; // teks tinggi
                                        } else {
                                            // Kondisi default jika status tidak sesuai dengan yang diharapkan
                                            $class = 'bg-secondary'; // misalnya warna abu-abu
                                            $text = 'Tidak Valid'; // teks tidak valid
                                        }
                                    @endphp
                                    <td>
                                        <div class="badge <?= $class ?>">
                                            <?= $text ?>
                                        </div>
                                    </td>
                                    <td>{{ $data->description }}</td>
                                    <td style="min-width: 50px">

                                        <div class="d-flex align-items-center justify-content-center grid gap-2">
                                            <a href="#" data-bs-toggle="dropdown"
                                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                                <div class="d-lg-inline-block">
                                                    <h6>Aksi</h6>
                                                </div>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('poverty.show', $data->id) }}" class="dropdown-item"
                                                    href="#"><i data-feather="alert-circle"></i> Detail</a>

                                                <a href="{{ route('poverty.edit', $data->id) }}" class="dropdown-item"
                                                    href="#"><i data-feather="edit"></i> Edit</a>
                                                <form onsubmit="return confirm('Apakah anda yakin?')"
                                                    action="{{ route('poverty.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item"><i data-feather="trash-2"></i>
                                                        Hapus
                                                    </button>
                                                </form>

                                            </div>
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
        @if (session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endpush
