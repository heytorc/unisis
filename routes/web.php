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
    
    $this->get('transfer', 'BalanceController@transfer')->name("balance.transfer");
    $this->post('confirm-transfer', 'BalanceController@confirmTransfer')->name("confirm.transfer");
    $this->post('transfer', 'BalanceController@transferStore')->name("store.transfer");

    $this->get('account', 'AccountController@index')->name("admin.account");

});

Route::get('/estoque', 'Estoque\\ProdutoController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
