<?php

require_once '../../includes/outros/config.php';
require_once '../../includes/outros/appException.php';
require_once '../../src/database/conecta.php';
require_once '../../src/helpers/funcoes_uteis.php';
require_once '../../src/services/usuarioServico.php';
require_once '../../src/models/usuario.php';

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new AppException('Método não permitido', 'error', 405);
    }

    validarCaptcha();

    $usuario = new Usuario(null, $_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['telefone']);

    inserirUsuario($pdo, $usuario);

    DarRetornoDoBackend(200, null, "success", "Bem-vindo!", "Cadastro realizado com sucesso. Redirecionando...", "area_do_usuario.php");

} catch (AppException $e) {
    DarRetornoDoBackend($e->getCode(), null, $e->getType(), "Atenção!", $e->getMessage(), null);
} catch (PDOException $e) {
    DarRetornoDoBackend(500, "Erro ao cadastrar no banco de dados: ".$e->getMessage(), "error", "Erro Técnico", "Instabilidade no servidor, tente novamente mais tarde", null);
} catch (Throwable $e){
    DarRetornoDoBackend(500, $e->getMessage(), "error", "Erro Desconhecido", "Houve um erro inesperado, tente novamente mais tarde", null);
}
