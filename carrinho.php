<?php
require_once 'controller/autentication.php';
@$cod = $_REQUEST['cod'];
if (isset($cod)) {
    if ($cod == 'sucess') {
        $_SESSION['carrinho'] = [];
    }
}
// Verificar se a sessão do carrinho existe e, se não, criá-la
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if ($_POST) {
    if(isset($_POST['action'])) { //ve se está pedindo uma ação interna
        /* ----------------------------------------- REMOVER CARRINHO ----------------------------------------- */
        if ($_POST['action'] === 'removeItem' && isset($_POST['produto_id'])) {
            $produtoId = $_POST['produto_id'];

            foreach ($_SESSION['carrinho'] as $indice => $produto) {
                if ($produto['id'] == $produtoId) {
                    unset($_SESSION['carrinho'][$indice]);
                    break;
                }
            }
        }
        /* ----------------------------------------- atualizar quantidade carrinho ----------------------------------------- */
        if ($_POST['action'] === 'updateQuantity' && isset($_POST['produto_id'], $_POST['nova_quantidade'])) {
            $produtoId = $_POST['produto_id'];
            $novaQuantidade = $_POST['nova_quantidade'];

            if ($novaQuantidade > 0) {
                foreach ($_SESSION['carrinho'] as &$produto) {
                    if ($produto['id'] == $produtoId) {
                        $produto['qntRequerida'] = $novaQuantidade;
                    }
                }
            } else {
                // Remover o item do carrinho se a nova quantidade for menor ou igual a 0
                foreach ($_SESSION['carrinho'] as $chave => $produto) {
                    if ($produto['id'] == $produtoId) {
                        unset($_SESSION['carrinho'][$chave]);
                    }
                }
            }
            header("Location: carrinho.php");
            exit;
        }
    /* ----------------------------------------- Adicionar ao carrinho ----------------------------------------- */
    } else if(isset($_SESSION['login']) && isset($_POST['idProduto']) && isset($_POST['nomeProduto']) && isset($_POST['precoProduto']) && isset($_POST['qntRequerida'])) {
        // Processar a solicitação de adicionar produtos ao carrinho
        $carrinhoIdProdutos = $_POST["idProduto"];
        $carrinhoNomeProdutos = $_POST["nomeProduto"];
        $carrinhoPrecoProdutos = $_POST["precoProduto"];
        $carrinhoImagemProdutos = $_POST["imagemProduto"];
        $carrinhoQntRequerida = $_POST["qntRequerida"];
        for ($i = 0; $i < count($carrinhoIdProdutos); $i++) {
            $produto = [
                'id' => $carrinhoIdProdutos[$i],
                'nome' => $carrinhoNomeProdutos[$i],
                'preco' => $carrinhoPrecoProdutos[$i],
                'imagem' => $carrinhoImagemProdutos[$i],
                'qntRequerida' => $carrinhoQntRequerida[$i],
            ];
            $produtoNoCarrinho = false;
            foreach ($_SESSION['carrinho'] as &$item) {
                if ($item['id'] == $produto['id']) {
                    $item['qntRequerida'] += $produto['qntRequerida'];
                    $produtoNoCarrinho = true;
                    break;
                }
            }
            if (!$produtoNoCarrinho) {
                $_SESSION['carrinho'][] = $produto;
            }
        }
        header("Location: carrinho.php");
        exit;
    }
}

/* ----------------------------------------- Calcular o preço total do carrinho ----------------------------------------- */
$precoTotalCarrinho = 0;
foreach ($_SESSION['carrinho'] as $produto) {
    $precoTotalCarrinho += $produto['qntRequerida'] * $produto['preco'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
</head>
<body>
    <main>
        <a href="index.php" class="backToThePage"><span class="material-symbols-outlined"> arrow_back </span></a>
        <?php
        if (isset($cod)) {
            if ($cod == 'sucess') {
                echo ('<br><p class="msgQuery carrinhoEnviado">');
                    echo ('Seu pedido foi efetuado com sucesso!');
                echo ('</p>');
            } else if ($cod == 'error') {
                echo ('<br><p class="msgQuery carrinhoNaoEnviado">');
                    echo ('Seu pedido não pode ser efetuado!');
                echo ('</p>');
            }
        }
        ?>
        <div class="carrinhoContainer">
            <?php
/* ----------------------------------------- ver se o carrinho está vazio ----------------------------------------- */
            if(empty($_SESSION['carrinho'])){
                echo '<div class="carroVazio">';
                    echo '<div>';
                        echo '<img src="img/carrinhoVazio.png" alt="carrinhoVazio"/>';
                        echo '<p>Seu carrinho está vazio!</p>';
                    echo '</div>';
                echo '</div>';
            }
            ?>
            <div class="carrinhoContainerList">
                <?php 
/* ----------------------------------------- print do carrinho ----------------------------------------- */
                if(!empty($_SESSION['carrinho'])){
                    foreach ($_SESSION['carrinho'] as $produto) {
                        echo '<div class="produtoCarrinho">';
                            echo '<div class="imgContainer"><img src="img/imgBanco/' . $produto['imagem'] . '" alt="' . $produto['nome'] . '"/></div>';
                                echo '<div class="infoProdutoCarrinho">';
                                    echo '<div class="textprodutoCarrinho">';
                                        echo '<p class="nomeCarrinho">' . $produto['nome'] . '</p>';
/* ----------------------------------------- Form editar carrinho ----------------------------------------- */                                    
/**/                                        echo '<form class="qntEditor" action="carrinho.php" method="post">';
/**/                                        echo '<input type="hidden" name="action" value="updateQuantity">';
/**/                                        echo '<input type="hidden" name="produto_id" value="'.$produto['id'].'">';
/**/                                        echo '<button class="qntBtn quantDown" type="submit" name="nova_quantidade" value="'.$produto['qntRequerida'] - 1 .'">-</button>';
/**/                                        echo '<p class="qntBtn viewQnt">'. $produto['qntRequerida'] .'</p>';
/**/                                        echo '<button class="qntBtn quantUp" type="submit" name="nova_quantidade" value="'.$produto['qntRequerida'] + 1 .'">+</button>';
/**/                                    echo '</form>';
/* ----------------------------------------- fim do form editar carrinho ----------------------------------------- */
                                        echo '<p class="precoCarrinho">Preço (unidade): R$'.number_format($produto['preco'], 2, ',', '.').'</p>';

                                    $precoTotalProduto = $produto['qntRequerida'] * $produto['preco'];
                                    echo '<p class="precoTotalProduto">Preço a ser pago: R$'.number_format($precoTotalProduto, 2, ',', '.').'</p>';
/* ----------------------------------------- Form remover do carrinho ----------------------------------------- */                                    
/**/                                echo '<form class="containerRemove" action="carrinho.php" method="post">';
/**/                                    echo '<input type="hidden" name="action" value="removeItem">';
/**/                                    echo '<input type="hidden" name="produto_id" value="'.$produto['id'].'">';
/**/                                    echo '<button type="submit"><span class="material-symbols-outlined">delete</span></button>';
/**/                                echo '</form>';
/* ----------------------------------------- fim do form remover do carrinho ----------------------------------------- */                                    
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </main>
    <footer>
        <div class="inFooter">
            <?php
/* ----------------------------------------- Calcular preco do carrinho ----------------------------------------- */                                    
            echo '<p class="precoTotalProdutos">Preço total do carrinho:'; 
            echo '<strong>R$'.number_format($precoTotalCarrinho, 2, ',', '.').'</strong>';
            echo '</p>';
            ?>
            <form method="post" action="controller/carrinhoController.php">
                <?php
/* ----------------------------------------- Inputs "falsos" para mandar para a controller  ----------------------------------------- */                                    
                foreach ($_SESSION['carrinho'] as $produto) {
                    echo '<input type="hidden" name="produtos[]" value="' . $produto['id'] . '">';
                    echo '<input type="hidden" name="quantidades[]" value="' . $produto['qntRequerida'] . '">';
                }
                echo '<input type="hidden" name="precoTotalCarrinho" value="' . $precoTotalCarrinho . '">';
                echo '<input type="hidden" name="usuarioID" value="' . $_SESSION['login'] . '">';
                ?>
                <button type="submit">Comprar</button>
            </form> 
        </div>
    </footer>
</body>
</html>
