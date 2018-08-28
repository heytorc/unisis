@extends('adminlte::page')

@section('title', 'Saldo')

@section('content')
<div class="row">
  <div class="col-md-4">
    <!-- Profile Image -->
    <div class="box box-success">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

        <h3 class="profile-username text-center">{{ $user->name }}</h3>

        <p class="text-muted text-center">Software Engineer</p>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Followers</b> <a class="pull-right">1,322</a>
          </li>
          <li class="list-group-item">
            <b>Following</b> <a class="pull-right">543</a>
          </li>
          <li class="list-group-item">
            <b>Friends</b> <a class="pull-right">13,287</a>
          </li>
        </ul>

        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <div class="col-md-8">
    <div class="box box-success">
      <div class="box-header">

      </div>
      <div class="box-body">

      </div>
    </div>
  </div>
</div>
@endsection