@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
    <h1>Saldo</h1>

    <ol class="breadcrumb">
        <li><a href="javascript:void(0)">Dashboard</a></li>
        <li><a href="javascript:void(0)">Saldo</a></li>
    </ol>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-green">
                <div class="inner">
                <p></p>
                
                <h3>R$ {{ number_format($amount,2,',','.') }}</h3>

                <p>&nbsp;</p>
                </div>
                <div class="icon">
                <i class="ion ion-cash"></i>
                </div>
                <div class="text-center"><button class="btn btn-primary btn-block btn-sm">Recarregar <i class="fa fa-shopping-cart"></i></button></div>
                <div class="text-center"><button class="btn btn-danger btn-block btn-sm">Sacar <i class="fa fa-shopping-cart"></i></button></div>
                <div class="text-center"><button class="btn btn-warning btn-block btn-sm">Histórico <i class="fa fa-history"></i></button></div>
            </div>
        </div>
    </div>

@stop