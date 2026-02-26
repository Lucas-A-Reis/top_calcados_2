<?php

require_once '../../includes/outros/config.php';
require_once '../../includes/outros/appException.php';
require_once '../../src/database/conecta.php';
require_once '../../src/helpers/funcoes_uteis.php';
require_once '../../src/services/usuarioServico.php';

header('Content-Type: application/json');

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

    if (!$dados_do_usuario || !password_verify($senha, $dados_do_usuario['senha'])) {
        throw new AppException("E-mail ou senha incorretos.", "warning", 401);
    }

    if (session_status() === PHP_SESSION_NONE) session_start();

    $_SESSION['usuario_id'] = $dados_do_usuario['id'];
    $_SESSION['usuario_nome'] = $dados_do_usuario['nome'];

    echo json_encode([
        "status" => "success",
        "title" => "Bem-vindo!",
        "message" => "Login realizado com sucesso. Redirecionando...",
        "redirect" => "area_do_usuario.php"
    ]);
} catch (AppException $e) {
    http_response_code($e->getCode());
    echo json_encode([
        "status" => $e->getType(),
        "title" => "Atenção",
        "message" => $e->getMessage()
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    error_log("Erro de Login (BD): " . $e->getMessage());
    echo json_encode([
        "status" => "error",
        "title" => "Erro Técnico",
        "message" => "Instabilidade no servidor. Tente novamente em instantes."
    ]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "title" => "Erro Inesperado",
        "message" => "Algo deu errado no processamento."
    ]);
}
