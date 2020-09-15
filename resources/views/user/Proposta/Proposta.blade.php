@extends('adminlte::page')

@section('content')
<div class="row">
    <div class="col-12">
        <a href="{{route('user.proposta.create')}}" class="btn btn-primary">Cadatrar Proposta</a>
        <form role="form" method="get" action="{{ route('user.buscaCliente')}}">
            {{ csrf_field() }}
              <input type="text" class="form-control" name="cliente" id="exampleInputEmail1" placeholder="Busca Cliente">
              <button type="submit" class="btn btn-primary">Pesquisar</button>
        </form>
        <form role="form" method="get" action="{{ route('user.proposta.Filter')}}">
            {{ csrf_field() }}
            <select name="filtro" class="form-control">
                <option value="1">Abertos</option>
                <option value="2">Fechados</option>
                <option value="3">Recentes</option>
                <option value="4">Antigos</option>
            </select>
              <button type="submit" class="btn btn-primary">Filtar</button>
        </form>
        <form role="form" method="get" action="{{ route('user.proposta.excel')}}">
            {{ csrf_field() }}
              <button type="submit" class="btn btn-primary">Exportar</button>
        </form>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lista de Proposta</h3>
          <div class="card-tools">
          </div>
        </div>
        @if(count($propostas) > 0)
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Proposta feita em</th>
                    <th>Inicio do pgto</th>
                    <th>Qtde. de parcelas</th>
                    <th>Sinal R$</th>
                    <th>Valor parcela R$</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            @foreach ( $propostas as $x )
            <tbody>
                <tr>
                    <td class="pt-4">{{ $x->nome_cliente }}</td>
                    <td class="pt-4">{{ $x->dt_proposta }}</td>
                    <td class="pt-4">{{ $x->dt_pagamento_proposta }}</td>
                    <td class="pt-4">{{ $x->qt_parcela }}</td>
                    <td class="pt-4">{{ $x->sinal_proposta }}</td>
                    <td class="pt-4">{{ $x->valor_parcela }}</td>
                    <td class="pt-4">{{ $x->valor_total_proposta }}</td>
                    @if($x->status_proposta == 1)
                    <td>
                        <button type="button" class="btn btn-primary btn-info" data-toggle="modal" data-target="#modalAdd{{ $x->id_proposta }}">Aberta</button>
                    </td>
                    @else
                    <td>
                        <button type="button" class="btn btn-primary btn-info" data-toggle="modal" data-target="#modalAdd{{ $x->id_proposta }}">Fechada</button>
                    </td>
                    @endif
                    <td> <a href="{{route('user.proposta.edit', ['id' => $x->id_proposta])}}" class="btn btn-primary">Editar</a></td>
                </tr>
            </tbody>
            <div class="modal fade" id="modalAdd{{ $x->id_proposta }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                      <h4 class="modal-title col-11 text-start pl-0"></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('user.proposta.status', ['id' => $x->id_proposta])}}" class="d-flex col-12 p-0 flex-column">
                          {{ csrf_field() }}
                          <div class="card-body">
                            <label>Status</label>
                            <select name="status_proposta" class="form-control">
                                <option value="1">Aberta</option>
                                <option value="0">Fechada</option>
                            </select>
                          </div>
                          <div class="boxBtnsForm d-flex justify-content-end">
                              <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">fechar</button>
                              <button type="submit" class="btn btn-primary text-white">confirmar</button>
                          </div>
                      </form>
                    </div>
                    <div class="modal-footer border-0">
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
        </table>
        {{-- Modal --}}

        @else
        Não há nenhuma proposta
        @endif
        </div>

        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
