<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DAMPI - Projek</title>

    <!-- Start Style -->
    <style>
        body{
          font-family: "Poppins", sans-serif;
        }
        #map{
            height: 100vh;
            width: 100%;
        }
        .btn{
          border-radius: 48px !important;
        }
        .form-control{
          border-radius: 48px !important;
        }
    </style>
    <!-- End Style -->

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>

    <link rel="shortcut icon" href="{{ asset('template/assets/images/dampi.svg') }}" type="image/x-icon">
</head>
<body>

  <!-- Start Navbar -->
  <div class="container">
    <nav class="navbar navbar-expand-lg py-4">
      <div class="container-fluid">

        <form class="d-flex ms-auto" role="search" action="{{ route('landing-search') }}" method="GET">
          <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-lg-0">
            <li class="nav-item mx-3">
              <button class="btn btn-primary" aria-current="page" type="submit">Projek 🛠️</button>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" aria-current="page" href="{{ route('landing-facility') }}">Fasilitas 🌏</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="{{ route('landing-tps') }}">TPS 🚮</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <!-- End Navbar -->

  <div id="map"></div>

  <!-- Modal -->
<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="projectName">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <img id="projectImage" src="" class="img-fluid" alt="project Image">
            </div>
            <div class="col-12 mt-5">
                <div class="d-flex justify-content-between">
                    <p class="text-secondary fw-regular">Lokasi Projek : </p>
                    <p id="projectAddress" class="fw-bold text-end" style="max-width: 50%"></p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="text-secondary fw-regular">Biaya Projek : </p>
                    <p id="projectCost" class="fw-bold text-end" style="max-width: 50%"></p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="text-secondary fw-regular">Status Projek : </p>
                    <p id="projectStatus" class="fw-bold text-end" style="max-width: 50%"></p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="text-secondary fw-regular">Tanggal Mulai Projek : </p>
                    <p id="p-start" class="fw-bold text-end" style="max-width: 50%"></p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="text-secondary fw-regular">Estimasi Selesai Projek : </p>
                    <p id="p-end" class="fw-bold"></p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="text-secondary fw-regular">Vendor : </p>
                    <div class="text-end" style="max-width: 50%">
                        <p id="companyName" class="fw-bold"></p>
                        <img id="companyImage" src="" class="img-fluid" alt="company Image">
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-5">
                    <p class="text-secondary fw-regular">Deskripsi : </p>
                    <p id="projectDesc" class="fw-bold"></p>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Start Leaflet JS -->
    <script>
        var map = L.map('map').setView([-2.5489, 118.0149], 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        @foreach ($projects as $project)
            var icon = L.icon({
                iconUrl: '{{ asset('images/pupr_warning.png') }}',
                iconSize: [38, 38],
                iconAnchor: [19, 38],
                popupAnchor: [0, -38]
            });

            var marker = L.marker([{{ $project->lat }}, {{ $project->long }}], { icon: icon }).addTo(map);
            marker.projectName = '{{ $project->name }}';
            marker.p_s = '{{ \Carbon\Carbon::parse($project->p_start)->format('d/m/Y') }}';
            marker.p_e = '{{ \Carbon\Carbon::parse($project->p_end)->format('d/m/Y') }}';
            marker.projectAddress = '{{ $project->address }}';
            marker.projectCost = 'Rp {{ number_format($project->cost) }}';
            marker.projectStatus = '{{ $project->status }}';
            marker.companyName = '{{ $project->companyName }}';
            marker.projectDesc = '{{ $project->description }}';
            marker.projectImageUrl = '{{ asset('/storage/project/'.$project->imageUrl) }}';
            marker.companyImage = '{{ asset('/storage/company/'.$project->companyImage) }}';
            marker.on('click', function(e){
                $('#projectName').text(this.projectName);
                $('#projectAddress').text(this.projectAddress);
                $('#projectStatus').text(this.projectStatus);
                $('#projectCost').text(this.projectCost);
                $('#p-start').text(this.p_s);
                $('#p-end').text(this.p_e);
                $('#companyName').text(this.companyName);
                $('#projectDesc').text(this.projectDesc);
                $('#projectImage').attr('src', this.projectImageUrl);
                $('#companyImage').attr('src', this.companyImage);
                $('#projectModal').modal('show');
            });
        @endforeach
    </script>
  <!-- End Leaflet JS -->
</body>
</html>
