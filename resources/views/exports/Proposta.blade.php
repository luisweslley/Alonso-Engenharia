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
            <td class="pt-4">Aberta</td>
        </td>
        @else
        <td>
            <td class="pt-4">Fechado</td>
        </td>
        @endif
    </tr>
</tbody>
@endforeach
</table>
