<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Proposta;
use App\Models\Cliente;
use App\Models\FileProposta;
use App\Models\LogradouroProposta;
use App\Models\ParcelaProposta;

use Exception;

use Maatwebsite\Excel\Facades\Excel;
use app\Exports\PropostaView;
class PropostaController extends Controller
{

    public function Index(Proposta $proposta){

        try{
            //Lista de propostas
            $userProposta = $proposta->ListProposta();

            return view('User.Proposta.Proposta',
                ['propostas' => $userProposta]);

        } catch(Exception $e){
            return redirect()->back();
        }
    }

    public function Create(Cliente $cliente){

        try{
            //Lista de clientes cadastrados
            $userCliente = $cliente->ListCliente();
            $cidades = DB::table('tb_cidade')->get();
            $estados = DB::table('tb_estado')->get();

            return view('User.Proposta.PropostaForm',
            ['clientes' => $userCliente,
            'cidades' => $cidades,
            'estados' => $estados]);

        } catch(Exception $e){
            return redirect()->back();
        }
    }

    public function Edit(Proposta $proposta, Cliente $cliente, int $id){

        try{
            //Listar cliente selecionado
            $userCliente = $cliente->ListCliente();
            $cidades = DB::table('tb_cidade')->get();
            $estados = DB::table('tb_estado')->get();

            //Proposta selecionada
            $userProposta = $proposta->EditProposta($id);

            return view('User.Proposta.PropostaEdit',
            ['clientes' => $userCliente,
            'userProposta' => $userProposta,
            'cidades' => $cidades,
            'estados' => $estados,
            'id' => $id]);

        } catch(Exception $e){
            return redirect()->back();
        }
    }

    public function Store(Request $request, Proposta $proposta, LogradouroProposta $logradouro,
    ParcelaProposta $parcela, FileProposta $FILE){


        $request->validate([
            'cliente' => 'required',
            'nm_logradouro' => 'required',
            'nm_cidade' => 'required',
            'nm_estado' => 'required',
            'valor_total_proposta' => 'required',
            'sinal_proposta' => 'required',
            'qt_parcela' => 'required',
            'valor_parcela' => 'required',
            'dt_pagamento_proposta' => 'required',
            'dt_parcela' => 'required',
            'cpf_responsavel_cliente' => 'required',
            'status_proposta' => 'required',

        ]);
        try{
            //Cadastrar Proposta
            $id = $proposta->CreateProposta(
            $request->valor_total_proposta,
            $request->sinal_proposta,
            $request->dt_pagamento_proposta,
             $request->status_proposta,
             $request->cliente);

            //Cadastrar Logradouro
            $logradouro->CreateLogradouroProposta($request->nm_logradouro, $request->nm_cidade,$id);

            //Cadastrar Parcela
            $parcela->CreateParcelaProposta($request->qt_parcela, $request->valor_parcela, $request->dt_parcela,$id);

            //Cadastrar FILE
            if ($request->hasFile('nm_file') && $request->file('nm_file')->isValid()) {
            $FILE->CreateFileProposta($request->nm_file,$id);
            }
            toastr()->success('sucesso.');
            return redirect()->route('user.proposta.index');

        } catch(Exception $e){
            return redirect()->back();
        }
    }

    public function Update(Request $request, Proposta $proposta, LogradouroProposta $logradouro,
    ParcelaProposta $parcela, FileProposta $FILE, int $id){

        $request->validate([
            'cliente' => 'required',
            'nm_logradouro' => 'required',
            'nm_cidade' => 'required',
            'nm_estado' => 'required',
            'valor_total_proposta' => 'required',
            'sinal_proposta' => 'required',
            'qt_parcela' => 'required',
            'valor_parcela' => 'required',
            'dt_pagamento_proposta' => 'required',
            'dt_parcela' => 'required',
            'status_proposta' => 'required',

        ]);
        try{
            // return dd($id);
            //Cadastrar Proposta
            $proposta->UpdateProposta($request->valor_total_proposta,
            $request->sinal_proposta,
            $request->dt_pagamento_proposta,
             $request->status_proposta,
             $request->cliente,$id);

            //Cadastrar Logradouro
            $logradouro->UpdateLogradouroProposta($request->nm_logradouro, $request->nm_cidade,$id);

            //Cadastrar Parcela
            $parcela->UpdateParcelaProposta($request->qt_parcela, $request->valor_parcela, $request->dt_parcela,$id);

            //Cadastrar FILE
            if ($request->hasFile('nm_file') && $request->file('nm_file')->isValid() && $request->nm_file != null) {
            $FILE->UpdateFileProposta($request->nm_file, $id);
            }
            toastr()->success('sucesso.');
            return redirect()->route('user.proposta.index');

        } catch(Exception $e){
            return redirect()->back();
        }
    }

    public function UpdateStatus(Request $request, Proposta $proposta, $id){

        $proposta->UpdateStatus($request->status_proposta,$id);

        return redirect()->route('user.proposta.index');

    }

    public function GerarPdf(Proposta $proposta){

        try{

            $userProposta = $proposta->ListProposta();

            return Excel::download(new PropostaView($userProposta),'Propostas-' . time() . '.xlsx');

        } catch(Exception $e){
            return redirect()->back();
        }
    }

    public function buscaCliente(Request $request, Proposta $proposta)
    {
        try {
            $nome = $request->get('cliente', null);
            $filter = $request->route()->getName();

           $searchCliente = $proposta->SearchCliente($nome);
            return view('User.Proposta.Proposta',
            ['propostas' => $searchCliente,
            'filter' => $filter,
            'Total' => $searchCliente]
            );
        } catch (Exception $e) {
            toastr()->error('Erro na pesquisa de Mural.');
            return redirect()->back();
        }
    }

    public function Filter(Request $request, Proposta $proposta){

        try {

            $statusFilter = $proposta->SearchStatus($request->filtro);

            return view('User.Proposta.Proposta',
            ['propostas' => $statusFilter]);
        } catch (Exception $e) {
            toastr()->error('Erro na pesquisa de Mural.');
            return redirect()->back();
        }
    }

}
