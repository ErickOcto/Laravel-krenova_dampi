@extends('admin.layouts.app')

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
                    <li class="breadcrumb-item"><a href="{{route('poverty.index')}}">Dashboard</a></li>
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
            <h4 class="card-title">Keluarga</h4>
        </div>
        <div class="card-body">
            <div class="row">

            <div class="mb-5" style="height: 80px; width: 76px;">
                <img src="/template/assets/images/avatar/avatar-s-1.png" alt="" srcset="">
            </div>
                <div class="col-md-5 ms-5">
                    ERIK SUBANDONO
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection