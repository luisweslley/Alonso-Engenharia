<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Exception;

class Logradouro extends Model
{
    protected $table = 'tb_logradouro';
    public $timestamps = false;

    protected $fillable = [
        'nm_logradouro',
        'id_cidade',
        'id_cliente'
    ];

    public function CreateLogradouro($nm_logradouro, $id_cidade, int $id){

        Logradouro::insert([
            'nm_logradouro' => $nm_logradouro,
            'id_cidade' => $id_cidade,
            'id_cliente' => $id
        ]);

        return true;
    }

    public function UpdateLogradouro($nm_logradouro, $id_cidade, int $id){

        Logradouro::where('id_cliente', $id)->update([
            'nm_logradouro' => $nm_logradouro,
            'id_cidade' => $id_cidade,
        ]);

        return true;
    }
}
