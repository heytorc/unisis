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
    $this->post('withdraw', 'BalanceController@withdrawStore')->name("withdraw.store");
    
    $this->get('transfer', 'BalanceController@transfer')->name("balance.transfer");

    $this->get('account', 'AccountController@index')->name("admin.account");

});

Route::get('/estoque', 'Estoque\\ProdutoController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
