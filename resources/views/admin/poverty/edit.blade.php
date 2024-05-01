@extends('admin.layouts.app')
@push('add-styles')
        <link rel="stylesheet" href="/template/assets/vendors/simple-datatables/style.css">
    @endpush
@section('content')
    
    <div class="main-content container-fluid">

        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Data Penduduk</h4>
                        </div>
                        <div class="card-content">

                            <div class="card-body">
                                <div class="page-title mb-3">
                                    <h4>Data Penduduk</h4>
                                </div>
                                <form class="form" action="{{ route('poverty.update', $poverty->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">Nama Kepala Keluarga</label>
                                                <input type="text" id="first-name-column" name="name"
                                                    value="{{ $poverty->name }}" class="form-control"
                                                    placeholder="Masukkan Nama Penduduk">
                                            </div>
                                            @error('name')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">NIK</label>
                                                <input type="text" id="first-name-column" name="nik"
                                                    value="{{ $poverty->nik }}" class="form-control"
                                                    placeholder="Masukkan NIK">
                                            </div>
                                            @error('name')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 col-8">
                                            <div class="form-group">
                                                <label for="tanggal-lahir-column">Tanggal Lahir</label>
                                                <input type="date" id="tanggal-lahir-column" name="birth_date"
                                                    value="{{ $poverty->birth_date }}" class="form-control"
                                                    placeholder="Masukkan Tanggal Lahir">
                                            </div>
                                            @error('tanggal_lahir')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-8">
                                            <div class="form-group">
                                                <label for="jenis-kelamin-column">Jenis Kelamin</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" name="gender">
                                                        <option value="">Pilih..</option>
                                                        <option value="male"
                                                            {{ $poverty->gender == 'male' ? 'selected' : '' }}>Laki - Laki
                                                        </option>
                                                        <option value="female"
                                                            {{ $poverty->gender == 'female' ? 'selected' : '' }}>Perempuan
                                                        </option>
                                                        <option value="nonbinary"
                                                            {{ $poverty->gender == 'nonbinary' ? 'selected' : '' }}>Non
                                                            Biner / Netral</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            @error('gender')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-8">
                                            <div class="row mt-4">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="0"
                                                            name="marriage" id="flexRadioDefault1"
                                                            {{ $poverty->marriage == 0 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Belum Menikah
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="1"
                                                            name="marriage" id="flexRadioDefault2"
                                                            {{ $poverty->marriage == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            Sudah Menikah
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="first-name-column">Total Tanggungan</label>
                                            <div class="input-group">
                                                <input type="number" id="first-name-column" name="total_dependents"
                                                    value="{{ $poverty->total_dependents }}" class="form-control"
                                                    placeholder="Masukkan Jumlah Tanggungan"
                                                    aria-describedby="basic-addon1">
                                                <span class="input-group-text" id="basic-addon1">Anggota Keluarga</span>

                                            </div>
                                            @error('total_dependents')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="first-name-column">Total Jumlah anggota keluarga</label>
                                            <div class="input-group">
                                                <input type="number" id="first-name-column" name="total_familymember"
                                                    value="{{ $poverty->total_familymember }}" class="form-control"
                                                    placeholder="Masukkan Jumlah Seluruh Anggota Keluarga"
                                                    aria-describedby="basic-addon1">
                                                <span class="input-group-text" id="basic-addon1">Anggota</span>

                                            </div>
                                            @error('total_familymember')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="status-pekerjaan-column">Status Pekerjaan</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" name="job_status">
                                                        <option value="">Pilih..</option>
                                                        <option value="freelance"
                                                            {{ $poverty->economy->job_status == 'freelance' ? 'selected' : '' }}>
                                                            Pekerja lepas atau pekerja mandiri</option>
                                                        <option value="parttime"
                                                            {{ $poverty->economy->job_status == 'parttime' ? 'selected' : '' }}>
                                                            Pekerja paruh waktu</option>
                                                        <option value="fulltime"
                                                            {{ $poverty->economy->job_status == 'fulltime' ? 'selected' : '' }}>
                                                            Pekerja penuh waktu</option>
                                                        <option value="unemployment"
                                                            {{ $poverty->economy->job_status == 'unemployment' ? 'selected' : '' }}>
                                                            Tidak bekerja</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            @error('job_status')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="kategori-pekerjaan-column">Kategori Pekerjaan</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" name="job_category">
                                                        <option value="">Pilih..</option>
                                                        <option value="wiraswasta"
                                                            {{ $poverty->economy->job_category == 'wiraswasta' ? 'selected' : '' }}>
                                                            Wiraswasta</option>
                                                        <option value="swasta"
                                                            {{ $poverty->economy->job_category == 'swasta' ? 'selected' : '' }}>
                                                            Swasta</option>
                                                        <option value="pns"
                                                            {{ $poverty->economy->job_category == 'pns' ? 'selected' : '' }}>
                                                            PNS</option>
                                                        <option value="tni"
                                                            {{ $poverty->economy->job_category == 'tni' ? 'selected' : '' }}>
                                                            TNI</option>
                                                        <option value="polisi"
                                                            {{ $poverty->economy->job_category == 'polisi' ? 'selected' : '' }}>
                                                            Polisi</option>
                                                        <option value="petani"
                                                            {{ $poverty->economy->job_category == 'petani' ? 'selected' : '' }}>
                                                            Petani</option>
                                                        <option value="buruh"
                                                            {{ $poverty->economy->job_category == 'buruh' ? 'selected' : '' }}>
                                                            Buruh</option>
                                                        <option value="profesional"
                                                            {{ $poverty->economy->job_category == 'profesional' ? 'selected' : '' }}>
                                                            Profesional</option>
                                                        <option value="pengajar"
                                                            {{ $poverty->economy->job_category == 'pengajar' ? 'selected' : '' }}>
                                                            Guru/Dosen</option>
                                                        <option value="art"
                                                            {{ $poverty->economy->job_category == 'art' ? 'selected' : '' }}>
                                                            Tenaga Kerja Rumah Tangga</option>
                                                        <option value="sosial"
                                                            {{ $poverty->economy->job_category == 'sosial' ? 'selected' : '' }}>
                                                            Pekerja Sosial</option>
                                                        <option value="seniman"
                                                            {{ $poverty->economy->job_category == 'seniman' ? 'selected' : '' }}>
                                                            Seniman/Artis</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            @error('job_category')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <label for="pendapatan-bulanan-column">Pendapatan Bulanan</label>
                                            <div class="input-group">
                                                <input type="text" id="pendapatan-bulanan-column"
                                                    name="monthly_income"
                                                    value="{{ number_format($poverty->economy->monthly_income, 0, ',', '.') }}"
                                                    class="form-control"
                                                    placeholder="Masukkan Rata Rata Pendapatan Bulanan"
                                                    aria-describedby="basic-addon1" onkeyup="formatRupiah(this)">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                            </div>
                                            @error('monthly_income')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="pengeluaran-bulanan-column">Pengeluaran Bulanan</label>
                                            <div class="input-group">
                                                <input type="text" id="pengeluaran-bulanan-column"
                                                    name="monthly_spending"
                                                    value="{{ number_format($poverty->economy->monthly_spending, 0, ',', '.') }}"
                                                    class="form-control"
                                                    placeholder="Masukkan Rata Rata Pengeluaran Bulanan"
                                                    aria-describedby="basic-addon2" onkeyup="formatRupiah(this)">
                                                <span class="input-group-text" id="basic-addon2">Rp</span>
                                            </div>
                                            @error('monthly_spending')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="deskripsi-column">Deskripsi</label>
                                                <textarea id="deskripsi-column" name="description" class="form-control" placeholder="Masukkan Deskripsi Penduduk"
                                                    rows="5">{{ $poverty->description }}</textarea>
                                            </div>
                                            @error('description')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>


                                        <div class="page-title mt-3 mb-3">
                                            <h4>Data Rumah</h4>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="kondisi-rumah-column">Kondisi Rumah</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" name="condition">
                                                        <option value="">Pilih..</option>
                                                        <option value="sobad"
                                                            {{ $poverty->house->condition == 'sobad' ? 'selected' : '' }}>
                                                            Sangat Buruk</option>
                                                        <option value="bad"
                                                            {{ $poverty->house->condition == 'bad' ? 'selected' : '' }}>
                                                            Buruk</option>
                                                        <option value="good"
                                                            {{ $poverty->house->condition == 'good' ? 'selected' : '' }}>
                                                            Baik</option>
                                                        <option value="sogood"
                                                            {{ $poverty->house->condition == 'sogood' ? 'selected' : '' }}>
                                                            Sangat Baik</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            @error('condition')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label for="first-name-column">Luas Tanah</label>
                                            <div class="input-group">
                                                <input type="number" id="first-name-column" name="wide_area"
                                                    value="{{ $poverty->house->wide_area }}" class="form-control"
                                                    placeholder="Masukkan Ukuran Luas Tanah"
                                                    aria-describedby="basic-addon1" oninput="formatRupiah(this)">
                                                <span class="input-group-text" id="basic-addon1">m²</span>

                                            </div>
                                            @error('wide_area')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label for="first-name-column">Luas Rumah</label>
                                            <div class="input-group">
                                                <input type="number" id="first-name-column" name="size_house"
                                                    value="{{ $poverty->house->size_house }}" class="form-control"
                                                    placeholder="Masukkan Ukuran Luas Rumah"
                                                    aria-describedby="basic-addon1" oninput="formatRupiah(this)">
                                                <span class="input-group-text" id="basic-addon1">m²</span>

                                            </div>
                                            @error('size_house')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label for="first-name-column">Total Kamar Tidur</label>
                                            <div class="input-group">
                                                <input type="number" id="first-name-column" name="totalbedroom"
                                                    value="{{ $poverty->house->totalbedroom }}" class="form-control"
                                                    placeholder="Masukkan Jumlah Kamar Tidur"
                                                    aria-describedby="basic-addon1" oninput="formatRupiah(this)">

                                            </div>
                                            @error('totalbedroom')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">Latitude</label>
                                                <input type="text" id="first-name-column" name="lat"
                                                    value="{{ $poverty->house->lat }}" class="form-control"
                                                    placeholder="Masukkan Latitude">
                                            </div>
                                            @error('lat')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">Longtitude</label>
                                                <input type="text" id="first-name-column" name="long"
                                                    value="{{ $poverty->house->long }}" class="form-control"
                                                    placeholder="Masukkan Longtitude">
                                            </div>
                                            @error('long')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <a href="{{ route('poverty.index') }}"
                                                class="btn btn-light-secondary me-1 mb-1">Kembali</a>
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

@push('add-scripts')
    <script src="/template/assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="/template/assets/js/vendors.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        function formatRupiah(angka) {
            var number_string = angka.value.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            angka.value = rupiah;
        }

        @if(session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');

        @endif
    </script>
@endpush
