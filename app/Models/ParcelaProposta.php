<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Exception;

class ParcelaProposta extends Model
{

    protected $table = 'tb_parcela_proposta';
    public $timestamps = false;

    protected $fillable = [
        'id_proposta',
        'qt_parcela',
        'valor_parcela',
        'qt_parcela'
    ];

    public function CreateParcelaProposta($qt_parcela, $valor_parcela, $dt_parcela, int $id){

        try{
            ParcelaProposta::insert([
                'id_proposta' => $id,
                'qt_parcela' => $qt_parcela,
                'valor_parcela' => $valor_parcela,
                'dt_parcela' => $dt_parcela
            ]);

            return true;
        } catch(Exception $e){
            return redirect()->back();
        }
    }

    public function UpdateParcelaProposta($qt_parcela, $valor_parcela, $dt_parcela, int $id){

        //
        try{
            ParcelaProposta::where('id_proposta', $id)
            ->update([
                'qt_parcela' => $qt_parcela,
                'valor_parcela' => $valor_parcela,
                'dt_parcela' => $dt_parcela
            ]);

        //     return true;
        } catch(Exception $e){
            return false;
        }
    }

}
