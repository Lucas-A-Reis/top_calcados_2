<?php

require_once '../../includes/back/config.php';
require_once '../../includes/back/appException.php';
require_once '../../src/database/conecta.php';
require_once '../../src/helpers/funcoes_uteis.php';
require_once '../../src/services/usuarioServico.php';
require_once '../../src/models/usuario.php';

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new AppException('Método não permitido', 'error', 405);
    }

    validarCaptcha();

    $usuario = new Usuario(null, sanitizar($_POST['nome'], 'string'), sanitizar($_POST['email'], 'email'), sanitizar($_POST['senha'], 'none'), sanitizar($_POST['telefone'], 'telefone'));

    inserirUsuario($pdo, $usuario);

    DarRetornoDoBackend(200, null, "success", "Cadastro realizado com sucesso. Redirecionando...", "/../front/area_do_usuario.php");

} catch (AppException $e) {
    DarRetornoDoBackend($e->getCode(), $e->getMessage(), $e->getType(), $e->getMessage(), null);
} catch (PDOException $e){
    DarRetornoDoBackend(500, $e->getMessage(), "error",  "Instabilidade no servidor, tente novamente mais tarde.", null);
} catch (Throwable $e){
    DarRetornoDoBackend(500, $e->getMessage(), "error", "Houve um erro inesperado, tente novamente mais tarde.", null);
}
