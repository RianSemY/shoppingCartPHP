<?php
if($_POST){
    $precoTotalPedido = $_POST["precoTotalCarrinho"];
    $usuarioIDpedido = $_POST["usuarioID"];

    $produtoIDlist = $_POST["produtos"];
    $produtoQTDlist = $_POST["quantidades"];

    if(isset($precoTotalPedido, $usuarioIDpedido, $produtoIDlist, $produtoIDlist)){
        require_once '../model/pedidosModel.php';
        $pedido = new pedidosModel();
        $pedido->setIdUsuario($usuarioIDpedido);
        $pedido->setPrecoPedido($precoTotalPedido);
        $lastID = $pedido->insert();

        require_once '../model/produtosPedidosModel.php';
        $pedidoProduto = new produtosPedidosModel();
        $pedidoProduto->inserirCadaProduto($produtoIDlist, $produtoQTDlist, $lastID);
        $_SESSION['carrinho'] = null;
        header('location:../carrinho.php?cod=sucess');
    } else{
        header('location:../carrinho.php?cod=error');
    }
} else{
    header('location: ../carrinho.php?cod=gg');
}