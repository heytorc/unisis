@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
    <h1>Saldo</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.balance') }}">Saque</a></li>
    </ol>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Saque</h3>
                </div>
                <div class="box-body">

                    @include('admin.includes.alerts')

                    <form action="{{ route('withdraw.store') }}" method="POST">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <input type="text" name="valor" class="form-control" placeholder="Digite o valor da saque..." />
                        </div>
                        <button type="submit" class="btn btn-success">Sacar</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>

@stop