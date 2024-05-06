<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DAMPI - Pencarian</title>

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
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-lg-0">
            <li class="nav-item mx-3">
              <a href="{{ route('landing-projects') }}" class="nav-link">Projek 🛠️</a>
            </li>
            <li class="nav-item mx-3">
              <a href="{{ route('landing-facility') }}" class="nav-link">Fasilitas 🌏</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="{{ route('landing-tps') }}">TPS 🚮</a>
            </li>
            <li class="nav-item mx-3">
              <button class="btn btn-primary" aria-current="page" type="submit">Ranking Fasilitas 🏆</button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <!-- End Navbar -->

  <div class="container">
    <div class="card table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        Nama Fasilitas
                    </th>
                    <th>
                        Jumlah Penghargaan
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facilities as $facility)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $facility->name }}</td>
                    <td>{{ $facility->award_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
