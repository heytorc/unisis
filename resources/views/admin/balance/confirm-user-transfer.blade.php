@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
    <h1>Transferência</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.balance') }}">Saldo</a></li>
    </ol>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Pra quem deseja transferir?</h3>
                </div>
                <div class="box-body">

                    @include('admin.includes.alerts')

                    <form action="{{ route('balance.transfer.confirmValue') }}" method="POST">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <input type="text" name="nmUsuarioDestino" class="form-control" placeholder="Digite o nome do usuário que deseja depositar..." />
                        </div>

                        <button type="submit" class="btn btn-success"><i class="fa fa-chevron-right"></i> Proxima Etapa</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>

@stop