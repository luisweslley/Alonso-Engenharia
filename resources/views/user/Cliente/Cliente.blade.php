@extends('adminlte::page')

@section('content')
<div class="row">
    <div class="col-12">
        @if(count($userCliente) > 0)
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lista de Cliente</h3>
          <div class="card-tools">
            <a href="{{route('user.cliente.create')}}" class="btn btn-primary">Cadatrar Cliente</a>
          </div>
        </div>
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Razão Social</th>
                    <th>Nome fantasia</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th>Nome Responsável</th>
                    <th>Celular Responsável</th>
                    <th>CPF Responsável</th>
                </tr>
            </thead>
            @foreach ( $userCliente as $x )
            <tbody>
                <tr>
                    <td class="pt-4">{{ $x->razao_social_cliente }}</td>
                    <td class="pt-4">{{ $x->nome_fantasia_cliente }}</td>
                    <td class="pt-4">{{ $x->cnpj_cliente }}</td>
                    <td class="pt-4">{{ $x->telefone_cliente }}</td>
                    <td class="pt-4">{{ $x->nm_responsavel_cliente }}</td>
                    <td class="pt-4">{{ $x->cpf_responsavel_cliente }}</td>
                    <td class="pt-4">{{ $x->celular_responsavel_cliente }}</td>
                    <td>
                    <a href="{{route('user.cliente.edit', ['id' => $x->id_cliente])}}" class="btn btn-primary">Editar</a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        </div>
        @else
        Não há nenhum cliente
        @endif
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
