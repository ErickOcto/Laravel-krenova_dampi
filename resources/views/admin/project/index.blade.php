@extends('admin.layouts.app')

@push('add-styles')
    <link rel="stylesheet" href="/template/assets/vendors/simple-datatables/style.css">
@endpush
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Projek</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-1 order-first">
                <div class="text-end">
                    <a href="{{ route('project.create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Daftar Projek yang ada di sistem
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Gambar</th>
                            <th>Perusahaan</th>
                            <th>Lat</th>
                            <th>Long</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Biaya</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td style="min-width: 200px">
                                {{ $project->name }}
                            </td>
                            <td style="min-width: 200px">
                                @if($project->status == "On Progress")
                                    <div class="badge bg-warning">
                                        Dalam Pengerjaan
                                    </div>
                                @elseif($project->status == "Completed")
                                    <div class="badge bg-success">
                                        Sukses
                                    </div>
                                @elseif($project->status == "Failed")
                                    <div class="badge bg-danger">
                                        Gagal
                                    </div>
                                @endif
                            </td>
                            <td style="min-width: 200px">
                                <img src="{{ asset('storage/project/'.$project->imageUrl)  }}" alt="{{ $project->imageUrl }}" style="max-width: 100px">
                            </td>
                            <td style="min-width: 200px">
                                {{ $project->companyName }}
                            </td>
                            <td style="min-width: 200px">
                                {{ $project->lat }}
                            </td>
                            <td style="min-width: 200px">
                                {{ $project->long }}
                            </td>
                            <td style="min-width: 200px">
                                {{ $project->p_start }}
                            </td>
                            <td style="min-width: 200px">
                                {{ $project->p_end }}
                            </td>
                            <td style="min-width: 200px">
                                {{ $project->cost }}
                            </td>
                            <td style="min-width: 200px">
                                {{ $project->address }}
                            </td>
                            <td style="min-width: 200px">
                                @if($project->status === "On Progress")
                                <div class="d-flex align-items-center justify-content-center grid gap-2">
                                    <a href="{{ route('project.edit', $project->id) }}" class="btn btn-warning">
                                        Edit
                                    </a>
                                    <form onsubmit="return confirm('Apakah anda yakin?')" action="{{ route('project.destroy', $project->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                    <form onsubmit="return confirm('Apakah anda yakin projek telah selesai?')" action="{{ route('updateStatusProject', $project->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-success">
                                            Selesai
                                        </button>
                                    </form>
                                </div>
                                @endif
                                @if($project->status === "Completed")
                                <div class="d-flex align-items-center justify-content-center grid gap-2">
                                    <div class="text-green">
                                        <p>Projek Ini Telah Selesai</p>
                                    </div>
                                </div>
                                @endif
                                @if($project->status === "Failed")
                                <div class="d-flex align-items-center justify-content-center grid gap-2">
                                    <div class="text-red">
                                        <p>Projek Ini Telah Gagal</p>
                                    </div>
                                </div>
                                @endif
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
