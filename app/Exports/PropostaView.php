<?php

namespace app\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PropostaView implements FromView
{
    protected $userProposta;

    public function __construct($userProposta){
        $this->userProposta = $userProposta;
    }


    public function view() : View
    {
        return view('exports.Proposta',[
            'userProposta' => $this->userProposta,

        ]);
    }
}
