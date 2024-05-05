@extends('admin.layouts.app')

@push('add-styles')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        #map {
            height: 100vh;
            width: 100%;
        }

        .btn {
            border-radius: 48px !important;
        }

        .form-control {
            border-radius: 48px !important;
        }
    </style>


    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endpush


@section('content')
    <div class="main-content container-fluid">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Data Penduduk</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('poverty.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Poverty</li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>

                        </ol>
                    </nav>
                </div>
            </div>

        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Keluarga</h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="/template/assets/images/avatar/avatar-s-1.png" alt="Foto Profil"
                                style="max-height: 200px; max-width: 150px;" class="img-fluid rounded">
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <p><b>Nama:</b> {{ $poverty->name }}</p>
                                    <p><b>NIK:</b> {{ $poverty->nik }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Tanggal Lahir:</b> {{ $poverty->birth_date }}</p>
                                    <p><b>Jenis Kelamin:</b>
                                        @if ($poverty->gender === 'male')
                                            Laki-Laki
                                        @elseif($poverty->gender === 'female')
                                            Perempuan
                                        @else
                                            Tidak Terdefinisi
                                        @endif
                                    </p>
                                    <p><b>Status Menikah:</b> {{ $poverty->marriage == 1 ? 'Menikah' : 'Belum Menikah' }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Total Tanggungan:</b> {{ $poverty->total_dependents }} Anggota Keluarga</p>
                                    <p><b>Jumlah Anggota Keluarga:</b> {{ $poverty->total_familymember }} Anggota Keluarga</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-2">
                    <div class="row">
                        <div class="col">
                            <p><b>Pekerjaan:</b> {{ $poverty->job_category }}</p>
                            <p><b>Status Pekerjaan:</b> {{ $poverty->job_status }}</p>
                        </div>
                        <div class="col">
                            <p><b>Pengeluaran Bulanan:</b> Rp.{{ number_format($poverty->monthly_spending, 0, ',', '.') }}</p>
                            <p><b>Pemasukan Bulanan:</b> Rp.{{ number_format($poverty->monthly_income, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <hr class="mt-2">
                    <div class="row">
                        <div class="col">
                            @php
                                $condition = $poverty->condition;
                                $keterangan = '';
            
                                if ($condition == 'sobad') {
                                    $keterangan = 'Sangat Buruk';
                                } elseif ($condition == 'bad') {
                                    $keterangan = 'Buruk';
                                } elseif ($condition == 'good') {
                                    $keterangan = 'Bagus';
                                } elseif ($condition == 'sogood') {
                                    $keterangan = 'Sangat Bagus';
                                } else {
                                    $keterangan = 'Tidak Diketahui';
                                }
                            @endphp
                            <p><b>Kondisi Rumah:</b> {{ $keterangan }}</p>
                            <p><b>Luas Tanah:</b> {{ $poverty->wide_area }} m2</p>
                        </div>
                        <div class="col">
                            <p><b>Ukuran Rumah:</b> {{ $poverty->size_house }} m2</p>
                            <p><b>Jumlah Kamar Tidur:</b> {{ $poverty->totalbedroom }} Kamar</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('add-scripts')
    <!-- Start Leaflet JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var map = L.map('map').setView([-2.5489, 118.0149], 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);


        var icon = L.icon({
            iconUrl: '{{ asset('/storage/poverty/location.png') }}',
            iconSize: [38, 38],
            iconAnchor: [19, 38],
            popupAnchor: [0, -38]
        });

        var marker = L.marker([{{ $poverty->lat }}, {{ $poverty->long }}], {
            icon: icon
        }).addTo(map);

        var genderLabel = '';

        switch ('{{ $poverty->gender }}') {
            case 'male':
                genderLabel = 'Laki-Laki';
                break;
            case 'female':
                genderLabel = 'Perempuan';
                break;
            default:
                genderLabel = 'Tidak Terdefinisi';
                break;
        }

        var povertyLabel = '';

        switch ('{{ $poverty->poverty_status }}') {
            case '0':
                povertyLabel = 'Biasa';
                break;
            case '1':
                povertyLabel = 'Menengah';
                break;
            case '2':
                povertyLabel = 'Ekstrem';
                break;
            default:
                povertyLabel = 'Tidak Terdefinisi';
                break;
        }

        var popupContent = '<div style="max-width: 200px;">' +
            '<h5 style="margin-bottom: 5px;">Informasi Penduduk</h5>' +
            '<p><b>Nama:</b> {{ $poverty->name }}</p>' +
            '<p><b>Jenis Kelamin:</b> ' + genderLabel + '</p>' +
            '<p><b>Pekerjaan:</b> {{ $poverty->job_category }}</p>' +
            '<p><b>Status Kemiskinan:</b> ' + povertyLabel + '</p>' +
            '<a href="https://www.google.com/maps?q={{ $poverty->lat }},{{ $poverty->long }}" target="_blank">Lihat Lokasi di Google Maps</a>' +
            '</div>';

        marker.bindTooltip('Rumah {{ $poverty->name }}').openTooltip();
        marker.bindPopup(popupContent).openPopup();
    </script>
@endpush
