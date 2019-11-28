<?php

$routes[] = ['/', 'HomeController@index'];
$routes[] = ['/usuario', 'UsuarioController@findAll'];
$routes[] = ['/usuario/{id}/update', 'UsuarioController@update'];
$routes[] = ['/usuario/insert', 'UsuarioController@insert'];
$routes[] = ['/usuario/{id}/delete', 'UsuarioController@delete'];
$routes[] = ['/usuario/{id}/findById', 'UsuarioController@findById'];
$routes[] = ['/usuario/cadastrar', 'UsuarioController@cadastrar'];
$routes[] = ['/usuario/{id}/visualizar', 'UsuarioController@visualizar'];
$routes[] = ['/produto', 'ProdutoController@findAll'];
$routes[] = ['/produto/{id}/update', 'ProdutoController@update'];
$routes[] = ['/produto/insert', 'ProdutoController@insert'];
$routes[] = ['/produto/{id}/delete', 'ProdutoController@delete'];
$routes[] = ['/produto/{id}/findById', 'ProdutoController@findById'];
$routes[] = ['/produto/cadastrar', 'ProdutoController@cadastrar'];
$routes[] = ['/produto/{id}/visualizar', 'ProdutoController@visualizar'];
$routes[] = ['/fornecedor', 'FornecedorController@findAll'];
$routes[] = ['/fornecedor/{id}/update', 'FornecedorController@update'];
$routes[] = ['/fornecedor/insert', 'FornecedorController@insert'];
$routes[] = ['/fornecedor/{id}/delete', 'FornecedorController@delete'];
$routes[] = ['/fornecedor/{id}/findById', 'FornecedorController@findById'];
$routes[] = ['/fornecedor/cadastrar', 'FornecedorController@cadastrar'];
$routes[] = ['/fornecedor/{id}/visualizar', 'FornecedorController@visualizar'];
$routes[] = ['/rocket', 'RocketController@findAll'];
$routes[] = ['/rocket/{id}/update', 'RocketController@update'];
$routes[] = ['/rocket/insert', 'RocketController@insert'];
$routes[] = ['/rocket/{id}/delete', 'RocketController@delete'];
$routes[] = ['/rocket/{id}/findById', 'RocketController@findById'];
$routes[] = ['/rocket/cadastrar', 'RocketController@cadastrar'];
$routes[] = ['/rocket/{id}/visualizar', 'RocketController@visualizar'];

return $routes;

?>