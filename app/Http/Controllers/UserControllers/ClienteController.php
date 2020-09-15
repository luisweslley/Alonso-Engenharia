<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ResponsavelCliente;
use App\Models\Cliente;
use App\Models\Logradouro;

use Exception;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{


    public function Index(Cliente $cliente){

        try{
            //Lista de clientes
            $userCliente = $cliente->ListCliente();
            // return dd($userCliente);

            return view('User.Cliente.Cliente',
            ['userCliente' => $userCliente]);

        } catch(Exception $e){
            return redirect()->back();
        }

    }

    public function Create(){

        try{
           $cidades = DB::table('tb_cidade')->get();
           $estados = DB::table('tb_estado')->get();
            return view('User.Cliente.ClienteForm',
          ['cidades' => $cidades,
            'estados' => $estados]);

        } catch(Exception $e){
            return redirect()->back();
        }
    }

    public function Edit(Cliente $cliente, int $id){

        try{
            //Listar cliente selecionado
            $userCliente = $cliente->EditCliente($id);
            $cidades = DB::table('tb_cidade')->get();
            $estados = DB::table('tb_estado')->get();
            return view('User.Cliente.ClienteEdit',
            ['userCliente' => $userCliente,
            'cidades' => $cidades,
            'estados' => $estados,
            'id' => $id]);

        } catch(Exception $e){
            return redirect()->back();
        }

    }

    public function Store(Request $request,Cliente $cliente, ResponsavelCliente $responsavel, Logradouro $logradouro){

        //validação de campos
        $request->validate([
        'razao_social_cliente' => 'required',
        'nome_fantasia_cliente' => 'required',
        'cnpj_cliente' => 'required',
        'email_cliente' => 'required',
        'telefone_cliente' => 'required',
        'nm_responsavel_cliente' => 'required',
        'cpf_responsavel_cliente' => 'required',
        'celular_responsavel_cliente' => 'required',
        ]);

        try{
            //Cadastrar Cliente
            $id = $cliente->CreateCliente(
            $request->razao_social_cliente,$request->nome_fantasia_cliente,$request->cnpj_cliente,
            $request->email_cliente, $request->telefone_cliente);

            // //Cadastrar Responsavel por cliente
            $responsavel->CreateResponsavelCliente($request->nm_responsavel_cliente,$request->cpf_responsavel_cliente,
            $request->celular_responsavel_cliente, $id);

            // //Cadastrar logradouro do cliente
            $logradouro->CreateLogradouro($request->nm_logradouro, $request->nm_cidade,$id);
            toastr()->success('sucesso.');
            return redirect()->route('user.proposta.index');

        } catch(Exception $e){
            return redirect()->back();
        }

    }

    public function Update(Request $request,Cliente $cliente, ResponsavelCliente $responsavel,
    Logradouro $logradouro, int $id){

        //validação de campos
        $request->validate([
            'razao_social_cliente' => 'required',
            'nome_fantasia_cliente' => 'required',
            'cnpj_cliente' => 'required',
            'email_cliente' => 'required',
            'telefone_cliente' => 'required',
            'nm_responsavel_cliente' => 'required',
            'cpf_responsavel_cliente' => 'required',
            'celular_responsavel_cliente' => 'required',
            ]);

        try{
            //Atualizar Cliente
            $cliente->UpdateCliente($request->razao_social_cliente,$request->nome_fantasia_cliente,$request->cnpj_cliente,
            $request->email_cliente, $request->telefone_cliente,$id);

            //Atualizar Responsavel por cliente
            $responsavel->UpdateResponsavelCliente($request->nm_responsavel_cliente,$request->cpf_responsavel_cliente,
            $request->celular_responsavel_cliente, $id);

            //Atualizar logradouro do cliente
            $logradouro->UpdateLogradouro($request->nm_logradouro, $request->nm_cidade,$id);
            toastr()->success('sucesso.');
            return redirect()->route('user.cliente.index');

        } catch(Exception $e){
            return redirect()->back();
        }

    }

}
