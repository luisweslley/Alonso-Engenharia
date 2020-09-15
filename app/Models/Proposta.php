<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use Exception;

class Proposta extends Model
{
    protected $table = 'tb_proposta';
    public $timestamps = false;


    protected $fillable = [
        'id_proposta',
        'servico_proposta',
        'valor_total_proposta',
        'sinal_proposta',
        'dt_pagamento_proposta',
        'status_proposta',
        'dt_proposta',
        'id_cliente'
    ];

    public function ListProposta(){

       $proposta = Proposta::select([
            'tb_proposta.id_proposta as id_proposta',
            'tb_cliente.nome_fantasia_cliente as nome_cliente',
            'tb_proposta.dt_proposta as dt_proposta',
            'tb_proposta.dt_pagamento_proposta as dt_pagamento_proposta',
            'tb_parcela_proposta.qt_parcela as qt_parcela',
            'tb_proposta.sinal_proposta as sinal_proposta',
            'tb_parcela_proposta.valor_parcela as valor_parcela',
            'tb_proposta.valor_total_proposta as valor_total_proposta',
            'tb_proposta.status_proposta as status_proposta',
        ])
        ->join('tb_cliente', 'tb_cliente.id_cliente', '=', 'tb_proposta.id_cliente')
        ->join('tb_parcela_proposta', 'tb_parcela_proposta.id_proposta', '=', 'tb_proposta.id_proposta' )
        ->get();

        return $proposta;
    }

    public function EditProposta(int $id){

        $proposta = Proposta::select([
             'tb_cliente.nome_fantasia_cliente as nome_cliente',
             'tb_proposta.dt_proposta as dt_proposta',
             'tb_proposta.dt_pagamento_proposta as dt_pagamento_proposta',
             'tb_parcela_proposta.qt_parcela as qt_parcela',
             'tb_proposta.sinal_proposta as sinal_proposta',
             'tb_parcela_proposta.valor_parcela as valor_parcela',
             'tb_parcela_proposta.dt_parcela as dt_parcela',
             'tb_proposta.valor_total_proposta as valor_total_proposta',
             'tb_proposta.status_proposta as status_proposta',
             'tb_logradouro_proposta.nm_logradouro_proposta as nm_logradouro',
             'tb_cidade.nm_cidade as nm_cidade',
             'tb_cidade.id_cidade as id_cidade',
             'tb_estado.nm_estado as nm_estado',
             'tb_estado.id_estado as id_estado',
             'tb_cliente.id_cliente as id_cliente'
         ])
         ->join('tb_cliente', 'tb_cliente.id_cliente', '=', 'tb_proposta.id_cliente')
         ->join('tb_parcela_proposta', 'tb_parcela_proposta.id_proposta', '=', 'tb_proposta.id_proposta' )
         ->join('tb_logradouro_proposta', 'tb_logradouro_proposta.id_proposta', '=', 'tb_proposta.id_proposta')
         ->join('tb_cidade', 'tb_cidade.id_cidade', '=', 'tb_logradouro_proposta.id_cidade')
         ->join('tb_estado', 'tb_estado.id_estado', '=', 'tb_cidade.id_estado')
         ->where('tb_proposta.id_proposta', $id)
         ->first();

         return $proposta;
     }

//Inserts DB
    public function CreateProposta($valor_total_proposta,
    $sinal_proposta,$dt_pagamento_proposta,$status_proposta,$id_cliente){

        // try{
            $increment = Proposta::max('id_proposta') + 1;
            $dataAtual = Carbon::now();

            $proposta = Proposta::insert([
                'id_proposta' => $increment,
                'valor_total_proposta' => $valor_total_proposta,
                'sinal_proposta' => $sinal_proposta,
                'dt_proposta' => $dataAtual,
                'dt_pagamento_proposta' => $dt_pagamento_proposta,
                'status_proposta' => $status_proposta,
                'id_cliente' => $id_cliente
            ]);

            return $increment;
        // } catch(Exception $e){
        //     return false;
        // }
    }

    public function UpdateProposta($valor_total_proposta,
    $sinal_proposta,$dt_pagamento_proposta,$status_proposta,$id_cliente,$id){

        try{
            Proposta::where('id_proposta', $id)
            ->update([
                'valor_total_proposta' => $valor_total_proposta,
                'sinal_proposta' => $sinal_proposta,
                'dt_pagamento_proposta' => $dt_pagamento_proposta,
                'status_proposta' => $status_proposta,
                'id_cliente' => $id_cliente
            ]);

            return true;
        } catch(Exception $e){
            return false;
        }

    }

    public function UpdateStatus($status,int $id){

        try{
            Proposta::where('id_proposta', $id)
            ->update([
                'status_proposta' => $status,
            ]);
            return true;
        } catch(Exception $e){
            return false;
        }
    }

    public function SearchCliente(string $nome){

        $cliente = Proposta::select([
            'tb_proposta.id_proposta as id_proposta',
            'tb_cliente.nome_fantasia_cliente as nome_cliente',
            'tb_proposta.dt_proposta as dt_proposta',
            'tb_proposta.dt_pagamento_proposta as dt_pagamento_proposta',
            'tb_parcela_proposta.qt_parcela as qt_parcela',
            'tb_proposta.sinal_proposta as sinal_proposta',
            'tb_parcela_proposta.valor_parcela as valor_parcela',
            'tb_proposta.valor_total_proposta as valor_total_proposta',
            'tb_proposta.status_proposta as status_proposta',
        ])
        ->join('tb_cliente', 'tb_cliente.id_cliente', '=', 'tb_proposta.id_cliente')
        ->join('tb_parcela_proposta', 'tb_parcela_proposta.id_proposta', '=', 'tb_proposta.id_proposta' )
            ->where('tb_cliente.nome_fantasia_cliente', 'like', '%' . $nome . '%')
            ->get();

        return $cliente;

    }

    public function SearchStatus(string $type){

        switch($type){
        //aberta
        case(1):
        $cliente = Proposta::select([
            'tb_proposta.id_proposta as id_proposta',
            'tb_cliente.nome_fantasia_cliente as nome_cliente',
            'tb_proposta.dt_proposta as dt_proposta',
            'tb_proposta.dt_pagamento_proposta as dt_pagamento_proposta',
            'tb_parcela_proposta.qt_parcela as qt_parcela',
            'tb_proposta.sinal_proposta as sinal_proposta',
            'tb_parcela_proposta.valor_parcela as valor_parcela',
            'tb_proposta.valor_total_proposta as valor_total_proposta',
            'tb_proposta.status_proposta as status_proposta',
        ])
        ->join('tb_cliente', 'tb_cliente.id_cliente', '=', 'tb_proposta.id_cliente')
        ->join('tb_parcela_proposta', 'tb_parcela_proposta.id_proposta', '=', 'tb_proposta.id_proposta' )
            ->where('tb_proposta.status_proposta', 1)
            ->get();
        break;
        //Fechada
        case(2):
            $cliente = Proposta::select([
                'tb_proposta.id_proposta as id_proposta',
                'tb_cliente.nome_fantasia_cliente as nome_cliente',
                'tb_proposta.dt_proposta as dt_proposta',
                'tb_proposta.dt_pagamento_proposta as dt_pagamento_proposta',
                'tb_parcela_proposta.qt_parcela as qt_parcela',
                'tb_proposta.sinal_proposta as sinal_proposta',
                'tb_parcela_proposta.valor_parcela as valor_parcela',
                'tb_proposta.valor_total_proposta as valor_total_proposta',
                'tb_proposta.status_proposta as status_proposta',
            ])
            ->join('tb_cliente', 'tb_cliente.id_cliente', '=', 'tb_proposta.id_cliente')
            ->join('tb_parcela_proposta', 'tb_parcela_proposta.id_proposta', '=', 'tb_proposta.id_proposta' )
            ->where('tb_proposta.status_proposta', 0)
                ->get();
        break;
        //recentes
        case(3):
            $cliente = Proposta::select([
                'tb_proposta.id_proposta as id_proposta',
                'tb_cliente.nome_fantasia_cliente as nome_cliente',
                'tb_proposta.dt_proposta as dt_proposta',
                'tb_proposta.dt_pagamento_proposta as dt_pagamento_proposta',
                'tb_parcela_proposta.qt_parcela as qt_parcela',
                'tb_proposta.sinal_proposta as sinal_proposta',
                'tb_parcela_proposta.valor_parcela as valor_parcela',
                'tb_proposta.valor_total_proposta as valor_total_proposta',
                'tb_proposta.status_proposta as status_proposta',
            ])
            ->join('tb_cliente', 'tb_cliente.id_cliente', '=', 'tb_proposta.id_cliente')
            ->join('tb_parcela_proposta', 'tb_parcela_proposta.id_proposta', '=', 'tb_proposta.id_proposta' )
            ->orderBy('dt_proposta', 'DESC')
                ->get();
        break;
        //Antigas
        case(4):
            $cliente = Proposta::select([
                'tb_proposta.id_proposta as id_proposta',
                'tb_cliente.nome_fantasia_cliente as nome_cliente',
                'tb_proposta.dt_proposta as dt_proposta',
                'tb_proposta.dt_pagamento_proposta as dt_pagamento_proposta',
                'tb_parcela_proposta.qt_parcela as qt_parcela',
                'tb_proposta.sinal_proposta as sinal_proposta',
                'tb_parcela_proposta.valor_parcela as valor_parcela',
                'tb_proposta.valor_total_proposta as valor_total_proposta',
                'tb_proposta.status_proposta as status_proposta',
            ])
            ->join('tb_cliente', 'tb_cliente.id_cliente', '=', 'tb_proposta.id_cliente')
            ->join('tb_parcela_proposta', 'tb_parcela_proposta.id_proposta', '=', 'tb_proposta.id_proposta' )
            ->orderBy('dt_proposta', 'ASC')
                ->get();
        break;
        }

        return $cliente;
    }



}
