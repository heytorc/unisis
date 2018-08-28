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
		<div class="col-md-12">
			<div class="box box-success">
				<div class="box-header">
				    <h3 class="box-title"><i class="fa fa-history"></i> &nbsp;Histórico de Movimentação</h3>
                    <form action="{{ route('historic.search') }}" method="post" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="text" name="id" class="form-control" placeholder="ID">
                        <input type="text" name="date" class="form-control" placeholder="dd/mm/aaaa">
                        <select name="type" class="form-control">
                            <option></option>
                            @foreach ($types as $key => $type)
                                <option value="{{ $key }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success">Pesquisar</button>
                    </form>
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
	</div>

@stop