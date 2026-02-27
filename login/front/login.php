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
        <div id="form-container">
            <form action="/../back/cadastro.php" method="POST">
                <h2>Crie sua conta</h2>
                <p>
                    Preencha os campos abaixo para ser cliente da Top Calçados.
                </p>

                <div class="campo-entrada">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Seu nome completo" required>
                </div>

                <div class="campo-entrada">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>
                </div>

                <div class="campo-entrada">
                    <label for="telefone">Telefone / WhatsApp</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="(37) 99999-0000" required>
                </div>

                <div class="campo-entrada">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Crie uma senha segura" required minlength="8">
                </div>

                <button type="submit" class="btn_acessar">Finalizar Cadastro</button>
            </form>
        </div>
    </main>
</body>

</html>