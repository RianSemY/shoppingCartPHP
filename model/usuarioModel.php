<?php
require_once 'ConexaoMySQL.php';

class usuarioModel{
    protected $id;
    protected $nome;
    protected $email;
    protected $senha;
    
    public function __construct() {
        echo 'a';} 
    public function getId() {
        return $this->id;}

    public function getNome() {
        return $this->nome;}

    public function getEmail() {
        return $this->email;}

    public function getSenha() {
        return $this->senha;}

    public function setNome($nome): void{
        $this->nome = $nome;}

    public function setEmail($email): void{
        $this->email = $email;}

    public function setSenha($senha): void{
        $this->senha = $senha;
    }
    
    
    public function autenticarUsuario($email, $senha) {
        $db = new ConexaoMysql();
        $db->Conectar();
        $email = $db->getConnection()->real_escape_string($email);
        $senha = $db->getConnection()->real_escape_string($senha);
        $sql = 'SELECT id_usuario FROM usuario WHERE email = "'.$email.'" AND senha = "'.$senha.'"';
        $resultado = $db->Consultar($sql);
        $db->Desconectar();
        return $resultado->num_rows == 1 ? $resultado->fetch_assoc()['id_usuario'] : false;
    }


    public function loadAll() {
        $db = new ConexaoMysql();
        $db->Conectar();
        $sql = 'SELECT * FROM clientes';
        $resultList = $db->Consultar($sql);
        $db->Desconectar();
        return $resultList;
    }
    
    public function loadNomeUsuario($id){
        $db = new ConexaoMysql();
        $db->Conectar();
        $sql = "SELECT nome FROM usuario where id_usuario = '$id'";
        $result = $db->Consultar($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nome = $row['nome'];
        } else {
            $nome = null;
        }
        $db->Desconectar();
        return $nome;
    }
    
    public function insert(){
        $db = new ConexaoMysql();
        $db->Conectar();
        $sql = 'INSERT INTO usuario (nome, email, senha) VALUES ("'.$this->nome.'","'.$this->email.'","'.$this->senha.'");';
        $db->Executar($sql);
        $db->Desconectar();
        return $db->total;
    }

    public function checkEmailExistence($email) {
        $db = new ConexaoMysql();
        $db->Conectar();
        $email = $db->getConnection()->real_escape_string($email);
        $sql = "SELECT COUNT(*) AS count FROM usuario WHERE email = '$email'";
        $resultado = $db->Consultar($sql);
        $db->Desconectar();
        $row = $resultado->fetch_assoc();
        return $row['count'] > 0;
    }
}
