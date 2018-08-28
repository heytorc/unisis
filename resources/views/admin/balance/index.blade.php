@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
	<h1>Saldo</h1>

	<ol class="breadcrumb">
		<li><a href="{{ route('admin.home') }}">Dashboard</a></li>
		<li><a href="{{ route('admin.balance') }}">Saldo</a></li>
	</ol>
@stop

@section('content')
	@include('admin.includes.alerts')
	<div class="row">
		<div class="col-md-9">
			<div class="box box-success">
				<div class="box-header">
				<h3 class="box-title"><i class="fa fa-history"></i> &nbsp;Histórico de Movimentação</h3>
				</div>
				<div class="box-body">
					<table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Valor</th>
                                <th>Tipo</th>
                                <th>Data</th>
                                <th>Sender</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($historics as $historic)
                            <tr>
                                <td>{{ $historic->id }}</td>
                                <td>{{ number_format($historic->amount, 2, ',', '.') }}</td>
                                <td>{{ $historic->type($historic->type) }}</td>
                                <td>{{ $historic->date }}</td>
                                <td>
                                    @if($historic->user_id_transaction)
                                        {{ $historic->userSender->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    @if (isset($dataForm))
                        {!! $historics->appends($dataForm)->links() !!}
                    @else
                        {!! $historics->links() !!}
                    @endif
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="small-box bg-green">
				<div class="inner">
					<p>Seu saldo</p>
					
					<h3>R$ {{ number_format($amount,2,',','.') }}</h3>
				</div>
				<div class="icon">
					<i class="ion ion-cash"></i>
				</div>
			</div>

			<div class="text-center"><a href="{{ route('balance.deposit') }}" class="btn btn-primary btn-block btn-sm"><i class="fa fa-shopping-cart"></i> Recarregar</a></div>
			<br>
			@if ($amount > 0)
			<div class="text-center"><a href="{{ route('balance.withdraw') }}" class="btn btn-danger btn-block btn-sm"><i class="fa fa-shopping-cart"></i> Sacar</a></div>
			<br>
			<div class="text-center"><a href="{{ route('balance.transfer.confirmUser') }}" class="btn btn-info btn-block btn-sm"><i class="fa fa-exchange"></i> Transferir</a></div>
			<br>
			@endif
			<div class="text-center"><a href="{{ route('admin.historic') }}" class="btn btn-warning btn-block btn-sm"><i class="fa fa-history"></i> Histórico</a></div>
		</div>
	</div>

@stop