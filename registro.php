<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <main>
        <div>
            <form action="controller/registroController.php" method="post">
                <div class="inputContainer">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" placeholder="Insira seu nome" required>
                </div>
                <div class="inputContainer">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Insira seu email" required>
                </div>
                <div class="inputContainer">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" placeholder="Insira uma senha" required>
                </div>
                <div class="inputContainer">
                    <label for="confirmarSenha">Confirmar senha:</label>
                    <input type="password" name="confirmarSenha" id="confirmarSenha" placeholder="Repita sua senha" required>
                </div>
                <div class="submitContainer">
                    <button type="submit">Enviar formulário</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>