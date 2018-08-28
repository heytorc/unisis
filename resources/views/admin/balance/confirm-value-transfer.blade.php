@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
    <h1>Confirmação de Transferência</h1>

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
                    <h3 class="box-title">Por favor, confirme os dados abaixo para realizar a transferênica:</h3>
                </div>
                <div class="box-body">

                    @include('admin.includes.alerts')

                    <h4><strong>Usuário de destino:</strong> {{ $sender->name }}</h4>
                    <h4><strong>Saldo atual:</strong> R$ {{ $balance->amount }}</h4>
                    <br>

                    <form action="{{ route('balance.transfer') }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="cdUsuarioDestino" value="{{ $sender->id }}">

                        <div class="form-group">
                            <label>Valor:</label>
                            <input type="text" name="valor" class="form-control" placeholder="Digite o valor para a transferência..." />
                        </div>

                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Transferir</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>

@stop