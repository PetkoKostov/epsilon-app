@extends('layouts.app')

@section('content')
    @if($service)
        <div class="row w-100 mb-3 text-center">
            <h1>{{ $service['name']  }}</h1>
        </div>
        <div class="row w-100">
            <div class="col-md-3">
                <div class="card border-info mx-sm-1 p-3">
                    <div class="card border-info shadow text-info p-3 service-card" ><span class="fa fa-cloud" aria-hidden="true"></span></div>
                    <div class="text-info text-center mt-3"><h5 class="text-decoration-underline">Service Type</h5></div>
                    <div class="text-info text-center mt-2"><h5>{{ $service['type']  }}</h5></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-success mx-sm-1 p-3">
                    <div class="card border-success shadow text-success p-3 service-card"><span class="fa fa-eye" aria-hidden="true"></span></div>
                    <div class="text-success text-center mt-3"><h5 class="text-decoration-underline">Network protection</h5></div>
                    <div class="text-success text-center mt-2"><h5>{{ $service['protected']  }}</h5></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-danger mx-sm-1 p-3">
                    <div class="card border-danger shadow text-danger p-3 service-card" ><span class="fa fa-money" aria-hidden="true"></span></div>
                    <div class="text-danger text-center mt-3"><h5 class="text-decoration-underline">Pricing model</h5></div>
                    <div class="text-danger text-center mt-2"><h5>{{ $service['pricing_model']  }}</h5></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-warning mx-sm-1 p-3">
                    <div class="card border-warning shadow text-warning p-3 service-card" ><span class="fa fa-fighter-jet" aria-hidden="true"></span></div>
                    <div class="text-warning text-center mt-3"><h5 class="text-decoration-underline">Speed</h5></div>
                    <div class="text-warning text-center mt-2"><h5>{{ $service['bandwidth']  }}</h5></div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4 mb20">
                <div class="text-bold fs14 mb5">
                    <i class="fa fa-cog mr5"></i> Status
                </div>
                {{ $service['status']  }}
            </div>
            <div class="col-md-4 mb20">
                <div class="text-bold fs14 mb5">
                    <i class="fa fa-globe mr5"></i> Port
                </div>
                <div>
                    {{ $service['port']['name']  }}
                </div>
            </div>
            <div class="col-md-4 mb20">
                <div class="text-bold fs14 mb5">
                    <i class="fa fa-calendar-check-o mr5"></i> Activation date
                </div>
                {{ \Carbon\Carbon::parse($service['created'])->format('Y-m-d')}}
            </div>
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            Service not found!
        </div>
    @endif
@endsection

@push('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <style>
        .service-card {
            position:absolute;
            left:40%;
            top:-20px;
            border-radius:50%;
        }
    </style>
@endpush