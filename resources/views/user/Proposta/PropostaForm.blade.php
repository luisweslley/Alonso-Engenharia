@extends('adminlte::page')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Criar Proposta</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" method="post" action="{{ route('user.proposta.store')}}">
        {{ csrf_field() }}
      <div class="card-body">
            <div class="form-group">
                <label>Clientes</label>
                <select name="cliente" class="form-control">
                    @foreach ($clientes as $x)
                    <option value="{{$x->id_cliente}}">{{$x->nome_fantasia_cliente}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Endereço</label>
                <input type="text" class="form-control" name="nm_logradouro">
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
          <label for="exampleInputEmail1">Valor Proposta</label>
          <input type="text" class="form-control" name="valor_total_proposta" >
        </div>
        <div class="form-group">
          <label>Sinal</label>
          <input type="text" class="form-control" name="sinal_proposta" >
        </div>
        <div class="form-group">
            <label>Quantidade de Parcela</label>
            <input type="text" class="form-control" name="qt_parcela">
          </div>
          <div class="form-group">
            <label>Valor das Parcelas</label>
            <input type="text" class="form-control" name="valor_parcela">
          </div>
          <div class="form-group">
            <label>Data de início do pagamento</label>
            <input type="date" class="form-control" name="dt_pagamento_proposta">
          </div>
          <div class="form-group">
            <label>Data do inicio das parcelas</label>
            <input type="date" class="form-control" name="dt_parcela">
          </div>
          <div class="form-group">
            <label>Responsavel CPF</label>
            <input type="text" class="form-control" name="cpf_responsavel_cliente">
          </div>

          <div class="form-group">
            <label>Status</label>
            <select name="status_proposta" class="form-control">
                <option value="1">Aberta</option>
                <option value="0">Fechada</option>
            </select>
          </div>
          <div class="form-group row">
            <label for="anexo" class="col-sm-3 col-form-label text-dark">Anexar Arquivo</label>
            <div class="col-sm-9 d-flex align-items-center">
                <label for="inputAnexo" id="labelAnexo" class="col-sm-2 form-control label-btn mb-0 mr-1 bg-info border-0 font-weight-normal d-flex flex-row align-items-center justify-content-center"><i class="icon ion-md-attach text-lg mr-1"></i> anexar</label>
                <div class="divFileName col-sm-10 text-secondary">Selecionar arquivo...</div>
                <input type="file" name="nm_file" accept=".pdf, .doc" value="teste" class="form-control d-none" id="inputAnexo">
            </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
    </form>
  </div>
@endsection
