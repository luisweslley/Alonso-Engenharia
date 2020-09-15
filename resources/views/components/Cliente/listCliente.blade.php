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
        </tr>
    </tbody>
    @endforeach
</table>
