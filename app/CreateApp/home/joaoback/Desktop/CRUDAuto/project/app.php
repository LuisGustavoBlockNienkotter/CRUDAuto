<?php

$route[] = ["/usuario', UsuarioController@index"];
$route[] = ["/usuario', UsuarioController@atualizar"];
$route[] = ["/usuario', UsuarioController@inserir"];
$route[] = ["/usuario', UsuarioController@deletar"];
$route[] = ["/produto', ProdutoController@index"];
$route[] = ["/produto', ProdutoController@atualizar"];
$route[] = ["/produto', ProdutoController@inserir"];
$route[] = ["/produto', ProdutoController@deletar"];
$route[] = ["/fornecedor', FornecedorController@index"];
$route[] = ["/fornecedor', FornecedorController@atualizar"];
$route[] = ["/fornecedor', FornecedorController@inserir"];
$route[] = ["/fornecedor', FornecedorController@deletar"];
$route[] = ["/rocket', RocketController@index"];
$route[] = ["/rocket', RocketController@atualizar"];
$route[] = ["/rocket', RocketController@inserir"];
$route[] = ["/rocket', RocketController@deletar"];

return $routes;

?>