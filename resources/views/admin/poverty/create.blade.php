@extends('admin.layouts.app')

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
                                <form class="form" action="{{ route('poverty.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">Nama Kepala Keluarga</label>
                                                <input required type="text" id="first-name-column" name="name"
                                                    class="form-control" placeholder="Masukkan Nama Penduduk">
                                            </div>
                                            @error('name')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">NIK</label>
                                                <input required type="text" id="first-name-column" name="nik"
                                                    class="form-control" placeholder="Masukkan NIK">
                                            </div>
                                            @error('nik')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 col-8">
                                            <div class="form-group">
                                                <label for="tanggal-lahir-column">Tanggal Lahir</label>
                                                <input required type="date" id="tanggal-lahir-column" name="birth_date"
                                                    class="form-control" placeholder="Masukkan Tanggal Lahir">
                                            </div>
                                            @error('tanggal_lahir')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-8">
                                            <div class="form-group">
                                                <label for="tanggal-lahir-column">Jenis Kelamin</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" name="gender">
                                                        <option value="">Pilih..</option>
                                                        <option value="male">Laki - Laki</option>
                                                        <option value="female">Perempuan</option>
                                                        <option value="nonbinary">Non Biner / Netral</option>

                                                    </select>
                                                </fieldset>
                                            </div>
                                            @error('jenis_kelamin')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-8">
                                            <div class="row mt-4">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input required class="form-check-input" type="radio" value="0"
                                                            name="marriage" id="flexRadioDefault1" checked>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Belum Menikah
                                                        </label>
                                                    </div>

                                                </div>
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input required class="form-check-input" type="radio" value="1"
                                                            name="marriage" id="flexRadioDefault2">
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            Sudah Menikah
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="total_dependents">Total Tanggungan</label>
                                            <div class="input-group">
                                                <input required type="number" id="total_dependents" name="total_dependents"
                                                    class="form-control" placeholder="Masukkan Jumlah Tanggungan"
                                                    aria-describedby="basic-addon1">
                                                <span class="input-group-text" id="basic-addon1">Anggota Keluarga</span>

                                            </div>
                                            @error('total_dependents')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="total_familymember">Total Jumlah anggota keluarga</label>
                                            <div class="input-group">
                                                <input required type="number" id="total_familymember" name="total_familymember"
                                                    class="form-control"
                                                    placeholder="Masukkan Jumlah Seluruh Anggota Keluarga"
                                                    aria-describedby="basic-addon1" onchange="calculatePovertyStatus()"
                                                    oninput="calculatePovertyStatus()">
                                                <span class="input-group-text" id="basic-addon1">Anggota</span>

                                            </div>
                                            @error('total_familymember')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="first-name-column">Status Pekerjaan</label>
                                                <fieldset class="form-group">
                                                    <select required class="form-select" name="job_status">
                                                        <option value="">Pilih..</option>
                                                        <option value="freelance">Pekerja lepas atau pekerja mandiri
                                                        </option>
                                                        <option value="parttime">Pekerja paruh waktu</option>
                                                        <option value="fulltime">Pekerja penuh waktu</option>
                                                        <option value="unemployment">Tidak bekerja</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            @error('job_status')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="first-name-column">Pekerjaan</label>
                                                <fieldset class="form-group">
                                                    <select required class="form-select" name="job_category">
                                                        <option value="">Pilih..</option>
                                                        <option value="wiraswasta">Wiraswasta</option>
                                                        <option value="swasta">Swasta</option>
                                                        <option value="pns">PNS</option>
                                                        <option value="tni">TNI</option>
                                                        <option value="polisi">Polisi</option>
                                                        <option value="petani">Petani</option>
                                                        <option value="buruh">Buruh</option>
                                                        <option value="profesional">Profesional</option>
                                                        <option value="pengajar">Guru/Dosen</option>
                                                        <option value="art">Tenaga Kerja Rumah Tangga</option>
                                                        <option value="sosial">Pekerja Sosial</option>
                                                        <option value="seniman">Seniman/Artis</option>
                                                        <option value="lainnya">Lainnya</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            
                                            @error('job_category')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 col-8">
                                            <label for="pendapatan-bulanan-column">Pendapatan Bulanan</label>
                                            <div class="input-group">
                                                <input required type="text" id="pendapatan-bulanan-column"
                                                    name="monthly_income" class="form-control"
                                                    placeholder="Masukkan Rata Rata Pendapatan Bulanan"
                                                    aria-describedby="basic-addon1" onkeyup="formatRupiah(this)"
                                                    onchange="calculatePovertyStatus()"
                                                    oninput="calculatePovertyStatus()">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                            </div>
                                            @error('monthly_income')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 col-8">
                                            <label for="pengeluaran-bulanan-column">Pengeluaran Bulanan</label>
                                            <div class="input-group">
                                                <input required type="text" id="pengeluaran-bulanan-column"
                                                    name="monthly_spending" class="form-control"
                                                    placeholder="Masukkan Rata Rata Pengeluaran Bulanan"
                                                    aria-describedby="basic-addon2" onkeyup="formatRupiah(this)">
                                                <span class="input-group-text" id="basic-addon2">Rp</span>
                                            </div>
                                            @error('monthly_spending')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 col-8">
                                            <div class="form-group">
                                                <label for="tanggal-lahir-column">Status Kemiskinan</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" name="poverty_status_1" disabled>
                                                        <option value="">Pilih..</option>
                                                        <option value="0">Biasa</option>
                                                        <option value="1">Menengah</option>
                                                        <option value="2">Ekstrem</option>
                                                    </select>
                                                    <input required type="hidden" name="poverty_status"
                                                        id="poverty_status_hidden">
                                                </fieldset>
                                            </div>
                                            @error('poverty_status')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">Deskripsi</label>
                                                <textarea id="first-name-column" name="description" class="form-control" placeholder="Masukkan Deskripsi Penduduk"
                                                    rows="5"></textarea>
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
                                                <label for="tanggal-lahir-column">Kondisi Rumah</label>
                                                <fieldset class="form-group">
                                                    <select required class="form-select" name="condition">
                                                        <option value="sobad">Sangat Buruk</option>
                                                        <option value="bad">Buruk</option>
                                                        <option value="good">Baik</option>
                                                        <option value="sogood">Sangat Baik</option>
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
                                                <input required type="number" id="first-name-column" name="wide_area"
                                                    class="form-control" placeholder="Masukkan Ukuran Luas Tanah"
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
                                                <input required type="number" id="first-name-column" name="size_house"
                                                    class="form-control" placeholder="Masukkan Ukuran Luas Rumah"
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
                                                <input required type="number" id="first-name-column" name="totalbedroom"
                                                    class="form-control" placeholder="Masukkan Jumlah Kamar Tidur"
                                                    aria-describedby="basic-addon1" oninput="formatRupiah(this)">

                                            </div>
                                            @error('totalbedroom')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">Latitude</label>
                                                <input required type="text" id="first-name-column" name="lat"
                                                    class="form-control" placeholder="Masukkan Latitude">
                                            </div>
                                            @error('lat')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">Longtitude</label>
                                                <input required type="text" id="first-name-column" name="long"
                                                    class="form-control" placeholder="Masukkan Longtitude">
                                            </div>
                                            @error('long')
                                                <strong class="alert alert-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>



                                        {{-- <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Gambar Fasilitas</label>
                                            <input required type="file" accept=".jpg, .png, .jpeg, .svg" id="first-name-column" name="imageUrl" class="form-control" placeholder="Masukkan Gambar Fasilitas">
                                        </div>
                                        @error('imageUrl')
                                            <strong class="alert alert-danger">{{ $message }}</strong>
                                        @enderror
                                    </div> --}}

                                        <div class="col-12 d-flex justify-content-end">
                                            <a href="{{ route('facility.index') }}"
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

        function calculatePovertyStatus() {
            var monthlyIncome = parseInt(document.getElementById('pendapatan-bulanan-column').value.replace(/\D/g, ''));
            var totalFamilyMember = parseInt(document.getElementById('total_familymember').value);

            var gkStandard = 743084;

            var gkSedang = gkStandard - (0.3 * gkStandard); // Batas untuk kategori "Sedang"
            var gkEkstrem = gkStandard - (0.5 * gkStandard); // Batas untuk kategori "Ekstrem"

            var povertyStatus = ''; // Status kemiskinan

            if (monthlyIncome < gkEkstrem * totalFamilyMember) {
                povertyStatus = '2';
            } else if (monthlyIncome < gkSedang * totalFamilyMember) {
                povertyStatus = '1';
            } else {
                povertyStatus = '0';
            }

            // Menetapkan nilai status kemiskinan ke dalam dropdown
            document.getElementsByName('poverty_status_1')[0].value = povertyStatus;
            document.getElementsByName('poverty_status')[0].value = povertyStatus;

        }


    </script>
@endpush
