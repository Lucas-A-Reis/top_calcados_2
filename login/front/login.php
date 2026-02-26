<?php

require_once '../../includes/outros/config.php';
require_once '../../src/database/conecta.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Calçados - Login</title>
    <link rel="stylesheet" href="">
    <?php include '../../includes/outros/favicons.html' ?>
</head>

<body>
    <main>
        <div class="form-container">
            <form action="/../back/login.php" method="POST">
                <h2>Já sou cadastrado</h2>

                <div class="campo-entrada">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>
                </div>
                <div class="campo-entrada">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Sua senha" required>
                </div>

                <button type="submit" class="btn_acessar">Entrar</button>

            </form>
        </div>
    </main>
</body>

</html>