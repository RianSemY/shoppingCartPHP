<?php
require_once 'ConexaoMySQL.php';

class produtosPedidosModel{
    private $pedido_id;
    private $produto_id;
    private $quantidade;

    public function __construct() {
        
    }
    public function getPedidoId() {
        return $this->pedido_id;
    }
    public function getProdutoId() {
        return $this->produto_id;
    }
    public function getQuantidade() {
        return $this->quantidade;
    }
    public function setPedidoId($pedido_id) {
        $this->pedido_id = $pedido_id;
    }
    public function setProdutoId($produto_id) {
        $this->produto_id = $produto_id;
    }
    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    
    public function inserirCadaProduto($produtoIDlist, $produtoQTDlist, $id_pedido){
        $db = new ConexaoMysql();
        $db->Conectar();
        for ($i = 0; $i < count($produtoIDlist); $i++) {            
            $sql = 'INSERT INTO produto_in_pedido (id_pedido, id_produto, qntPorUnidade) values ("'.$id_pedido.'", "'.$produtoIDlist[$i].'", "'.$produtoQTDlist[$i].'");';
            $db->Executar($sql);
        }
        $db->Desconectar();
        return $db->total;
    }
}