<?php

require_once("config.php");

/* executando o metodo select da classe Sql diretamente
$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
*/

/*executando o comando da classe Usuário*/
// $usuario = new Usuario();
// $usuario->loadById(2);

// echo $usuario;

/*
    lista com todos os usuários
    $lista = Usuario::getList();

    echo json_encode($lista);

*/

//lista de usuários pesquisando por login

// $search = Usuario::search("J");

// echo json_encode($search);

/* // carrega um usuário utilizando o login e senha como parametro.
$usuario = new Usuario();
$usuario->login("Jiraya","QwertyMan");
echo $usuario;
*/

//inserindo um usuário no banco com PDO e procedure

/*
$jiban = new Usuario("Jaspion", "J4sp!0n");
$jiban->insert();

echo $jiban;

*/


/*
//update com DAO
$usuario = new Usuario();

$usuario->loadById(5);

$usuario->update("LionMan", "L10nM4n");

echo $usuario;

*/

$usuario = new Usuario();
$usuario->loadById(6);
$usuario->delete();

echo $usuario;





?>