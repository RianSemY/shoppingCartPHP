<?php
require_once 'ConexaoMySQL.php';
class produtosModel{
    protected $id;
    protected $nome;
    protected $imagem;
    protected $preco;


    public function __construct() {}
    public function getId() {
        return $this->id;}
    public function getNome() {
        return $this->nome;}
    public function getImagem() {
        return $this->imagem;}
    public function getPreco() {
        return $this->preco;}
    public function setId($id): void {
        $this->id = $id;}
    public function setNome($nome): void {
        $this->nome = $nome;}
    public function setImagem($imagem): void {
        $this->imagem = $imagem;}
    public function setPreco($preco):void{
        $this->preco = $preco;
    }

    public function loadAllProdutos() {
        $db = new ConexaoMysql();
        $db->Conectar();
        $sql = 'SELECT * FROM produto';
        $resultList = $db->Consultar($sql);
        $db->Desconectar();
        return $resultList;
    }
}
