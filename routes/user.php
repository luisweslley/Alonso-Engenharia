<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['user']], function () {
    //Home
    Route::get('/home', 'UserControllers\HomeController@index')->name('home');
    //Cliente Rotas
    Route::get('/cliente', 'UserControllers\ClienteController@Index')->name('cliente.index');
    Route::get('/cliente/criar-cliente', 'UserControllers\ClienteController@Create')->name('cliente.create');
    Route::get('/cliente/editar-cliente/{id}', 'UserControllers\ClienteController@Edit')->name('cliente.edit');
    Route::post('/cliente/store-cliente', 'UserControllers\ClienteController@Store')->name('cliente.store');
    Route::post('/cliente/update-cliente/{id}', 'UserControllers\ClienteController@Update')->name('cliente.update');
;

    //Proposta Rotas
    Route::get('/proposta', 'UserControllers\PropostaController@Index')->name('proposta.index');
    Route::get('/proposta/filtrar', 'UserControllers\PropostaController@Filter')->name('proposta.Filter');
    Route::get('/proposta/criar-proposta', 'UserControllers\PropostaController@Create')->name('proposta.create');
    Route::get('/proposta/editar-proposta/{id}', 'UserControllers\PropostaController@Edit')->name('proposta.edit');
    Route::get('/proposta/exportar-proposta', 'UserControllers\PropostaController@GerarPdf')->name('proposta.excel');
    Route::get('/buscaCliente', array('as' => 'buscaCliente', 'uses' => 'UserControllers\PropostaController@buscaCliente'));
    Route::post('/proposta/store-proposta', 'UserControllers\PropostaController@Store')->name('proposta.store');
    Route::post('/proposta/update-proposta/{id}', 'UserControllers\PropostaController@Update')->name('proposta.update');
    Route::post('/proposta/update-status/{id}', 'UserControllers\PropostaController@UpdateStatus')->name('proposta.status');
});
