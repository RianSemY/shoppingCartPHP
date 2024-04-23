<?php
require_once 'controller/autentication.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
</head>
<body>
    <main>
        <div>
            <?php
            require_once 'controller/produtosController.php';
            $produtosList = loadAllProdutos();
            foreach($produtosList as $produto){
                echo $produto['id_produto'];
                echo '<br>';
                echo $produto['nome'];
                echo '<br>';
                echo $produto['imagem'];
                echo '<br>';
                echo $produto['preco'];

                echo '<form method="post" action="carrinho.php">';
                    echo '<input type="hidden" name="idProduto[]" value="'.$produto['id_produto'].'">';
                    echo '<input type="hidden" name="nomeProduto[]" value="'.$produto['nome'].'">';
                    echo '<input type="hidden" name="imagemProduto[]" value="'.$produto['imagem'].'">';
                    echo '<input type="hidden" name="precoProduto[]" value="'.$produto['preco'].'">';

                    echo '<input type="number" class="estoqueInput" name="qntRequerida[]" min="1" value="1"/>';
                    echo '<button type="submit">Comprar agora</button></a>';
                echo'</form>';
                echo '<br><br>';
            }
            ?>
        </div>
    </main>
</body>
</html>