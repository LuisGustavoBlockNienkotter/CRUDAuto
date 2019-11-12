<?php

$routes[] = ['/', 'HomeController@index'];
$routes[] = ['/usuario', 'UsuarioController@index'];
$routes[] = ['/usuario/{id}/atualizar', 'UsuarioController@atualizar'];
$routes[] = ['/usuario/{id}/inserir', 'UsuarioController@inserir'];
$routes[] = ['/usuario/{id}/deletar', 'UsuarioController@deletar'];
$routes[] = ['/usuario/{id}/listar', 'UsuarioController@listar'];
$routes[] = ['/produto', 'ProdutoController@index'];
$routes[] = ['/produto/{id}/atualizar', 'ProdutoController@atualizar'];
$routes[] = ['/produto/{id}/inserir', 'ProdutoController@inserir'];
$routes[] = ['/produto/{id}/deletar', 'ProdutoController@deletar'];
$routes[] = ['/produto/{id}/listar', 'ProdutoController@listar'];
$routes[] = ['/fornecedor', 'FornecedorController@index'];
$routes[] = ['/fornecedor/{id}/atualizar', 'FornecedorController@atualizar'];
$routes[] = ['/fornecedor/{id}/inserir', 'FornecedorController@inserir'];
$routes[] = ['/fornecedor/{id}/deletar', 'FornecedorController@deletar'];
$routes[] = ['/fornecedor/{id}/listar', 'FornecedorController@listar'];
$routes[] = ['/rocket', 'RocketController@index'];
$routes[] = ['/rocket/{id}/atualizar', 'RocketController@atualizar'];
$routes[] = ['/rocket/{id}/inserir', 'RocketController@inserir'];
$routes[] = ['/rocket/{id}/deletar', 'RocketController@deletar'];
$routes[] = ['/rocket/{id}/listar', 'RocketController@listar'];

return $routes;

?>