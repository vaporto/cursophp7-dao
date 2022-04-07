<?php

class Usuario{
    private $idUsuario;
    private $login;
    private $senha;
    private $dtCadastro;

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function getLogin(){
        return $this->login;
    }
    
    public function getSenha(){
        return $this->senha;
    }

    public function getDtCadastro(){
        return $this->dtCadastro;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function setLogin($login){
        $this->login = $login;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function setDtCadastro($dtCadastro){
        $this->dtCadastro = $dtCadastro;
    }

    public function loadById($id){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idUsuario = :ID", array(
         ":ID"=>$id   
        ));
        if(count($results) > 0){
            $row = $results[0];

            $this->setIdUsuario($row["idUsuario"]);
            $this->setLogin($row["login"]);
            $this->setSenha($row["senha"]);
            $this->setDtCadastro(new DateTime($row["dtCadastro"]));
        }

    }

    public function __toString(){

        return json_encode(array(
            "idUsuario"=>$this->getIdUsuario(),
            "login"=>$this->getLogin(),
            "senha"=>$this->getSenha(),
            "dtCadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
        ));
    }




}




?>