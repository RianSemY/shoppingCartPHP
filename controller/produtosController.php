<?php
function loadAllProdutos(){
    require_once './model/produtosModel.php';
    $produtos = new produtosModel();
    $produtosList = $produtos->loadAllProdutos();
    return $produtosList;
}