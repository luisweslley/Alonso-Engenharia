@extends('adminlte::page')

@section('content')
<link rel="stylesheet" href="{{ asset('../css/styleHome/styleHome.css')}}">
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    @component('components.home.smallbox')
    @slot('route', route('user.cliente.index'))
    @slot('image', 'ion ion-file')
    @slot('title','Clientes')
    @endcomponent
   </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    @component('components.home.smallbox')
    @slot('route', route('user.proposta.index'))
    @slot('image', 'ion ion-bag')
    @slot('title','Propostas')
    @endcomponent
  </div>
  <a href="{{ route('logout') }}" class="nav-link">
    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>
    <i class="nav-icon fas ion-md-log-out"></i>
    <p>Sair</p>

</div>

@endsection
