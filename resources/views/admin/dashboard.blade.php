@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix">
        <div class="col-md-6 col-sm-12">
            <h1>Dashboard</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Smart School</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="icon-user"></i></div>
                    <div class="ml-4">
                        <span>Akun Siswa</span>
                        <h4 class="mb-0 font-weight-medium">3M</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="icon-user"></i></div>
                    <div class="ml-4">
                        <span>Akun Guru</span>
                        <h4 class="mb-0 font-weight-medium">500K</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="icon-user"></i></div>
                    <div class="ml-4">
                        <span>Akun Admin</span>
                        <h4 class="mb-0 font-weight-medium">100K</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-success text-white rounded-circle"><i class="icon-user"></i></div>
                    <div class="ml-4">
                        <span>Total Akun</span>
                        <h4 class="mb-0 font-weight-medium">3,6M</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-sm-12">
        <div class="card">
            <div class="body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Statistik Akun</h6>                                    
                    </div>
                    <ul class="nav nav-tabs2">
                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#t-month">Bulan</a></li>
                    </ul>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <small>Laporan kenaikan jumlah akun siswa dan guru perbulan</small>
                        <div class="d-flex justify-content-start mt-3">
                            <div class="mr-5">
                            <label class="mb-0">Siswa</label>
                            <h4>9,231</h4>
                            </div>
                            <div>
                            <label class="mb-0">Guru</label>
                            <h4>10,850</h4>
                            </div>
                        </div>
                        <div id="chart-donut" style="height: 250px"></div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div id="flotChart" class="flot-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/bundles/flotscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/jvectormap.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/knob.bundle.js')}}"></script>

<script src="{{asset('assets/js/index4.js')}}"></script>
@endsection