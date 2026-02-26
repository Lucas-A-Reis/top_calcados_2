<?php

require_once '../../includes/outros/config.php';
require_once '../../src/database/conecta.php';
require_once '../../src/helpers/funcoes_uteis.php';
require_once '../../src/services/usuarioServico.php';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizar($_POST['email'], 'email');
    $senha = sanitizar($_POST['senha'], 'none');

    $dados_do_usuario = buscarUsuarioPorEmail($pdo, $email);

    if ($dados_do_usuario && password_verify($senha, $dados_do_usuario['senha'])) {
        session_start();
        $_SESSION['usuario_id'] = $dados_do_usuario['id'];
        $_SESSION['usuario_nome'] = $dados_do_usuario['nome'];
        header("Location: area_do_usuario.php");
    } else {
        header("Location: login.php?erro=1");
        exit();
    }
}


