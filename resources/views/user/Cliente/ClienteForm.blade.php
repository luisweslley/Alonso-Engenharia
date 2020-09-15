@extends('adminlte::page')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Criar Cliente</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" method="post" action="{{ route('user.cliente.store')}}">
        {{ csrf_field() }}
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Razao Social</label>
          <input type="text" class="form-control" name="razao_social_cliente" id="exampleInputEmail1" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label>Nome Fantasia</label>
          <input type="text" class="form-control" name="nome_fantasia_cliente" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label>CNPJ</label>
            <input type="text" class="form-control" name="cnpj_cliente" id="exampleInputPassword1">
          </div>
          <div class="form-group">
            <label>Endereço</label>
            <input type="text" class="form-control" name="nm_logradouro" id="exampleInputPassword1">
          </div>
          <div class="form-group">
            <label>Cidade</label>
            <select name="nm_cidade" class="form-control">
                @foreach ($cidades as $x)
                <option value="{{$x->id_cidade}}">{{$x->nm_cidade}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Estado</label>
            <select name="nm_estado" class="form-control">
                @foreach ($estados as $x)
                <option value="{{$x->id_estado}}">{{$x->nm_estado}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email_cliente" id="exampleInputPassword1">
          </div>
          <div class="form-group">
            <label>Telefone</label>
            <input type="text" class="form-control" name="telefone_cliente" id="exampleInputPassword1">
          </div>
          <div class="form-group">
            <label>Nome Responsavel</label>
            <input type="text" class="form-control" name="nm_responsavel_cliente" id="exampleInputPassword1">
          </div>
          <div class="form-group">
            <label>Responsavel CPF</label>
            <input type="text" class="form-control" name="cpf_responsavel_cliente" id="exampleInputPassword1">
          </div>
          <div class="form-group">
            <label>Responsavel Celular</label>
            <input type="text" class="form-control" name="celular_responsavel_cliente" id="exampleInputPassword1">
          </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection
