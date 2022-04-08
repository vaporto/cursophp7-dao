<?php

class Usuario{
    private $idUsuario;
    private $login;
    private $senha;
    private $dtCadastro;

    public function __construct($login ="", $senha=""){
        $this->setLogin($login);
        $this->setSenha($senha);
    }

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
            $this->setData($results[0]);
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

    public static function getList(){
        $sql = new Sql();
    
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY login;");
    }


    public static function search($login){
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios where login LIKE :SEARCH ORDER BY login", Array(
            ':SEARCH'=>"%".$login."%"
        ));
    }



    public function login($login, $senha){

        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE login = :LOGIN AND senha = :SENHA", array(
         ":LOGIN"=>$login,
         ":SENHA"=>$senha  
        ));
        if(count($results) > 0){
        
            $this->setData($results[0]);
        } else{
            throw new Exception("Login ou senha inválidos!");
        }

    }


    public function setData($data){

        $this->setIdUsuario($data["idUsuario"]);
        $this->setLogin($data["login"]);
        $this->setSenha($data["senha"]);
        $this->setDtCadastro(new DateTime($data["dtCadastro"]));
    }

    public function insert(){
        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
        ':LOGIN'=>$this->getLogin(),
        ':SENHA'=>$this->getSenha()    
        ));

        if(count($results) > 0){
            $this->setData($results[0]);
        }
    }


    public function update($login, $senha){

        $this->setLogin($login);
        $this->setSenha($senha);
    
        $sql = new Sql();
        $sql->query("UPDATE tb_usuarios set login = :LOGIN, senha = :SENHA WHERE idUsuario = :ID", array(
        ':LOGIN'=>$this->getLogin(),
        ':SENHA'=>$this->getSenha(),
        ':ID'=>$this->getIdUsuario()
        ));

    }

    public function delete(){
        $sql = new Sql();
        $sql->query("DELETE FROM tb_usuarios where idUsuario = :ID", array(
           ':ID'=>$this->getIdUsuario()
        ));

        $this->setIdUsuario(0);
        $this->setLogin("");
        $this->setSenha("");
        $this->setDtCadastro(new DateTime());

    }

}



?>