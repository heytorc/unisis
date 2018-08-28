@extends('templates.bootstrap-template')

@section('title', 'Meu Perfil')

@section('content')

<div class="container">
    <h1>Meu Perfil</h1>

    @include('admin.includes.alerts')

    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
    </div>

    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}">
    </div>

    <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="image">Imagem:</label>
        <input type="file" name="image">
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>

    </form>

</div>
@endsection