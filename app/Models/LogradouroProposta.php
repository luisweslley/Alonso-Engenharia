<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Exception;

class LogradouroProposta extends Model
{
    protected $table = 'tb_logradouro_proposta';
    public $timestamps = false;

    protected $fillable = [
        'nm_logradouro_proposta',
        'id_cidade',
        'id_proposta'
    ];

    public function CreateLogradouroProposta($nm_logradouro_proposta, $id_cidade, int $id){

        try{
            LogradouroProposta::insert([
                'nm_logradouro_proposta' => $nm_logradouro_proposta,
                'id_cidade' => $id_cidade,
                'id_proposta' => $id
            ]);

        //     return true;
        } catch(Exception $e){
            return false;
        }
    }

    public function UpdateLogradouroProposta($nm_logradouro_proposta, $id_cidade, int $id){

        try{
            LogradouroProposta::where('id_proposta', $id)->update([
                'nm_logradouro_proposta' => $nm_logradouro_proposta,
                'id_cidade' => $id_cidade,
            ]);

        //     return true;
        } catch(Exception $e){
            return false;
        }
    }
}
