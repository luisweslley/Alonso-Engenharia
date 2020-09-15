<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Exception;

class ResponsavelCliente extends Model
{
    protected $table = 'tb_responsavel_cliente';

    protected $fillable = [
        'nm_responsavel_cliente',
        'cpf_responsavel_cliente',
        'celular_responsavel_cliente',
        'id_clinte',
    ];

     public function CreateResponsavelCliente($nm_responsavel_cliente,$cpf_responsavel_cliente,
     $celular_responsavel_cliente, $id){

        try{
            ResponsavelCliente::insert([
                'nm_responsavel_cliente' => $nm_responsavel_cliente,
                'cpf_responsavel_cliente' => $cpf_responsavel_cliente,
                'celular_responsavel_cliente' => $celular_responsavel_cliente,
                'id_cliente' => $id,
            ]);

            return true;
        } catch(Exception $e){
            return false;
        }
    }

     public function UpdateResponsavelCliente($nm_responsavel_cliente,$cpf_responsavel_cliente,
     $celular_responsavel_cliente, int $id){

        try{
            ResponsavelCliente::where('id_cliente', $id)->update([
                'nm_responsavel_cliente' => $nm_responsavel_cliente,
                'cpf_responsavel_cliente' => $cpf_responsavel_cliente,
                'celular_responsavel_cliente' => $celular_responsavel_cliente,
            ]);

            return true;
        } catch(Exception $e){
            return false;
        }
    }
}
