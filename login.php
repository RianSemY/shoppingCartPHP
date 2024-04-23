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
            <form action="controller/loginController.php" method="post">
                <div class="inputContainer">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Insira seu email" required>
                </div>
                <div class="inputContainer">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" placeholder="Insira sua senha" required>
                </div>
                <div class="submitContainer">
                    <button type="submit">Fazer login</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>