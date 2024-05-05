@extends('admin.layouts.app')

@push('add-styles')
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
            <h3>Dashboard</h3>
        </div>
        <section class="section">

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
    <script>
        var map = L.map('map').setView([-2.5489, 118.0149], 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        @foreach ($poverty as $poverty)
            @php
                $iconUrl = '';
                switch ($poverty->poverty_status) {
                    case '0':
                        $iconUrl = asset('/poverty/green.png');
                        break;
                    case '1':
                        $iconUrl = asset('/poverty/yellow.png');
                        break;
                    case '2':
                        $iconUrl = asset('/poverty/red.png');
                        break;
                    default:
                        $iconUrl = asset('/poverty/green.png'); // Gambar default jika status tidak terdefinisi
                        break;
                }
            @endphp
            var icon = L.icon({
                iconUrl: '{{ $iconUrl }}',
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
        @endforeach
    </script>
@endpush
<!-- Bootstrap JS -->
