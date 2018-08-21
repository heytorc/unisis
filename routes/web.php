<?php

//Site Routes
Route::get('/', 'Site\\SiteController@index');

//Admin Routes
$this->group(['middleware' => ['auth'], 'namespace' => 'Admin'], function(){
    
    $this->get('admin', 'AdminController@index')->name("admin.home");

});

Route::get('/estoque', 'Estoque\\ProdutoController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
