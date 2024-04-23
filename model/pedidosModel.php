<?php
require_once 'ConexaoMySQL.php';
class pedidosModel{
    private $pedido_id;
    private $id_usuario;
    private $data_pedido;
    private $status_pedido;
    private $preco_pedido;

    public function __construct() {
        
    }
    public function getIdPedido() {
        return $this->pedido_id;
    }
    public function setIdPedido($pedido_id) {
        $this->pedido_id = $pedido_id;
    }
    public function getIdUsuario() {
        return $this->id_usuario;
    }
    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    public function getDataPedido() {
        return $this->data_pedido;
    }
    public function setDataPedido($data_pedido) {
        $this->data_pedido = $data_pedido;
    }
    public function getStatusPedido() {
        return $this->status_pedido;
    }
    public function setStatusPedido($status_pedido) {
        $this->status_pedido = $status_pedido;
    }
    public function getPrecoPedido() {
        return $this->preco_pedido;
    }

    public function setPrecoPedido($preco_pedido) {
        $this->preco_pedido = $preco_pedido;
    }


    public function insert(){
        $db = new ConexaoMysql();
        $db->Conectar();
        $sql = 'INSERT INTO pedido (id_usuario, preco_pedido) values ("'.$this->id_usuario.'", "'.$this->preco_pedido.'");';

        $lastID = $db->Executar($sql);
        $db->Desconectar();
        
        return $lastID;
    }

    public function loadAll() {
        $db = new ConexaoMysql();
        $db->Conectar();
        $sql = 'SELECT * FROM pedido';
        $resultList = $db->Consultar($sql);
        $db->Desconectar();
        return $resultList;
    }
}


