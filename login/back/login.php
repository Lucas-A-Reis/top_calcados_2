<?php

require_once '../../includes/outros/config.php';
require_once '../../includes/outros/appException.php';
require_once '../../src/database/conecta.php';
require_once '../../src/helpers/funcoes_uteis.php';
require_once '../../src/services/usuarioServico.php';


try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new AppException("Método não permitido.", "error", 405);
    }

    $email = sanitizar($_POST['email'] ?? '', 'email');
    $senha = sanitizar($_POST['senha'] ?? '', 'none');

    if (empty($email) || empty($senha)) {
        throw new AppException("Por favor, preencha todos os campos.", "warning");
    }

    $dados_do_usuario = buscarUsuarioPorEmail($pdo, $email);

    if (!password_verify($senha, $dados_do_usuario['senha'])) {
        throw new AppException("E-mail ou senha incorretos.", "warning", 401);
    }

    if (session_status() === PHP_SESSION_NONE) session_start();

    $_SESSION['usuario_id'] = $dados_do_usuario['id'];
    $_SESSION['usuario_nome'] = $dados_do_usuario['nome'];

    DarRetornoDoBackend(200, null, "success", "Login realizado com sucesso. Redirecionando...", "/../front/area_do_usuario.php");

} catch (AppException $e) {
    DarRetornoDoBackend($e->getCode(), null, $e->getType(), $e->getMessage(), null);
} catch (PDOException $e) {
    DarRetornoDoBackend(500, "Erro ao consultar o banco de dados :".$e->getMessage(), "error",  "Instabilidade no servidor, tente novamente mais tarde.", null);
} catch (Throwable $e) {
    DarRetornoDoBackend(500, $e->getMessage(), "error", "Houve um erro inesperado, tente novamente mais tarde.", null);
}
