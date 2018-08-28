<?php

//Site Routes
Route::get('/', 'Site\\SiteController@index');

//Admin Routes
$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){
    
    $this->get('/', 'AdminController@index')->name("admin.home");
    
    $this->get('balance', 'BalanceController@index')->name("admin.balance");
    
    $this->get('deposit', 'BalanceController@deposit')->name("balance.deposit");
    $this->post('deposit', 'BalanceController@depositStore')->name("deposit.store");
    
    $this->get('withdraw', 'BalanceController@withdraw')->name("balance.withdraw");
    $this->post('withdraw', 'BalanceController@withdrawStore')->name("store.withdraw");
    
    $this->get('transfer/confirm-user', 'BalanceController@confirmUsertransfer')->name("balance.transfer.confirmUser");
    $this->post('transfer/confirm-value', 'BalanceController@confirmValueTransfer')->name("balance.transfer.confirmValue");
    $this->post('transfer/transfer', 'BalanceController@storeTransfer')->name("balance.transfer");

    $this->get('historic', 'BalanceController@historic')->name('admin.historic');
    $this->any('historic-search', 'BalanceController@searchHistorics')->name('historic.search');


    $this->get('account', 'AccountController@index')->name("admin.account");

});

$this->get('meu-perfil', 'Admin\\UserController@profile')->name('profile')->middleware('auth');
$this->post('meu-perfil/atualizar', 'Admin\\UserController@profileUpdate')->name('profile.update')->middleware('auth');

Route::get('/estoque', 'Estoque\\ProdutoController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
