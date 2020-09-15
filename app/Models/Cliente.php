<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Exception;

class Cliente extends Model
{
    protected $table = 'tb_cliente';
    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'razao_social_cliente',
        'nome_fantasia_cliente',
        'cnpj_cliente',
        'email_cliente',
        'telefone_cliente',
        'id_user'
    ];

    public function ListCliente(){

       $cliente = Cliente::select([
            'tb_cliente.id_cliente as id_cliente',
            'tb_cliente.razao_social_cliente as razao_social_cliente',
            'tb_cliente.nome_fantasia_cliente as nome_fantasia_cliente',
            'tb_cliente.cnpj_cliente as cnpj_cliente',
            'tb_cliente.telefone_cliente as telefone_cliente',
            'tb_responsavel_cliente.nm_responsavel_cliente',
            'tb_responsavel_cliente.cpf_responsavel_cliente',
            'tb_responsavel_cliente.celular_responsavel_cliente',
            'tb_cidade.nm_cidade as nm_cidade',
            'tb_cidade.id_cidade as id_cidade',
            'tb_estado.nm_estado as nm_estado',
            'tb_estado.id_estado as id_estado',
        ])->join('tb_responsavel_cliente', 'tb_responsavel_cliente.id_cliente', '=', 'tb_cliente.id_cliente')
        ->join('tb_logradouro', 'tb_logradouro.id_cliente', '=', 'tb_cliente.id_cliente')
        ->join('tb_cidade', 'tb_cidade.id_cidade', '=', 'tb_logradouro.id_cidade')
        ->join('tb_estado', 'tb_estado.id_estado', '=', 'tb_cidade.id_estado')
        ->get();

        return $cliente;
    }

    public function EditCliente($id){

        $cliente = Cliente::select([
            'tb_cliente.razao_social_cliente as razao_social_cliente',
            'tb_cliente.nome_fantasia_cliente as nome_fantasia_cliente',
            'tb_cliente.cnpj_cliente as cnpj_cliente',
            'tb_cliente.email_cliente as email_cliente',
            'tb_cliente.telefone_cliente as telefone_cliente',
            'tb_responsavel_cliente.nm_responsavel_cliente',
            'tb_responsavel_cliente.cpf_responsavel_cliente',
            'tb_responsavel_cliente.celular_responsavel_cliente',
            'tb_logradouro.nm_logradouro as nm_logradouro',
            'tb_cidade.nm_cidade as nm_cidade',
            'tb_cidade.id_cidade as id_cidade',
            'tb_estado.nm_estado as nm_estado',
            'tb_estado.id_estado as id_estado',
        ])->join('tb_responsavel_cliente', 'tb_responsavel_cliente.id_cliente', '=', 'tb_cliente.id_cliente')
        ->join('tb_logradouro', 'tb_logradouro.id_cliente', '=', 'tb_cliente.id_cliente')
        ->join('tb_cidade', 'tb_cidade.id_cidade', '=', 'tb_logradouro.id_cidade')
        ->join('tb_estado', 'tb_estado.id_estado', '=', 'tb_cidade.id_estado')
        ->where('tb_cliente.id_cliente', $id)
        ->first();

        return $cliente;
    }

    public function CreateCliente($razao_social_cliente,$nome_fantasia_cliente,$cnpj_cliente,
    $email_cliente, $telefone_cliente){
        try{
            $userAtual = Auth::user()->id;
            $increment = Cliente::max('id_cliente') + 1;

            $cliente = Cliente::insert([
                'id_cliente' => $increment,
                'razao_social_cliente' => $razao_social_cliente,
                'nome_fantasia_cliente' => $nome_fantasia_cliente,
                'cnpj_cliente' => $cnpj_cliente,
                'email_cliente' => $email_cliente,
                'telefone_cliente' => $telefone_cliente,
                'id_user' => $userAtual
            ]);
            $id = Cliente::max('id_cliente');

            return  $id;
        } catch(Exception $e){
            return false;
        }
    }

    public function UpdateCliente($razao_social_cliente,$nome_fantasia_cliente,$cnpj_cliente,
    $email_cliente, $telefone_cliente, int $id){

        try{

            Cliente::where('id_cliente', $id)->update([
                'razao_social_cliente' => $razao_social_cliente,
                'nome_fantasia_cliente' => $nome_fantasia_cliente,
                'cnpj_cliente' => $cnpj_cliente,
                'email_cliente' => $email_cliente,
                'telefone_cliente' => $telefone_cliente,
            ]);

            return true;
        } catch(Exception $e){
            return false;
        }
    }

}
