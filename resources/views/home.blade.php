@extends('layouts.auth')

@section('content')
<p class="login-box-msg">Bem vindo a Alonso Engenharia</p>
<div class="content">
    {{-- <div class="boxCenter"> --}}
      {{-- <h1 class="logo">Bem vindo ao Sveik</h1> --}}
      <div class="boxContent">
        <div class="boxTop">
        <a href="{{url('user/login')}}" class="btn btn-primary btn-block">Entrar</a>
        </div>
        <div class="boxBottom">
          <a href="{{url('user/register')}}" class="btn btn-primary btn-block">Cadastrar</a>
        </div>
      </div>
    {{-- </div> --}}
  </div>

@endsection
