<?php

$routes[] = ['/', 'HomeController@index'];
$routes[] = ['/usuario', 'UsuarioController@findAll'];
$routes[] = ['/usuario/{id}/update', 'UsuarioController@update'];
$routes[] = ['/usuario/{id}/insert', 'UsuarioController@insert'];
$routes[] = ['/usuario/{id}/delete', 'UsuarioController@delete'];
$routes[] = ['/usuario/{id}/findById', 'UsuarioController@findById'];
$routes[] = ['/produto', 'ProdutoController@findAll'];
$routes[] = ['/produto/{id}/update', 'ProdutoController@update'];
$routes[] = ['/produto/{id}/insert', 'ProdutoController@insert'];
$routes[] = ['/produto/{id}/delete', 'ProdutoController@delete'];
$routes[] = ['/produto/{id}/findById', 'ProdutoController@findById'];
$routes[] = ['/fornecedor', 'FornecedorController@findAll'];
$routes[] = ['/fornecedor/{id}/update', 'FornecedorController@update'];
$routes[] = ['/fornecedor/{id}/insert', 'FornecedorController@insert'];
$routes[] = ['/fornecedor/{id}/delete', 'FornecedorController@delete'];
$routes[] = ['/fornecedor/{id}/findById', 'FornecedorController@findById'];
$routes[] = ['/rocket', 'RocketController@findAll'];
$routes[] = ['/rocket/{id}/update', 'RocketController@update'];
$routes[] = ['/rocket/{id}/insert', 'RocketController@insert'];
$routes[] = ['/rocket/{id}/delete', 'RocketController@delete'];
$routes[] = ['/rocket/{id}/findById', 'RocketController@findById'];

return $routes;

?>