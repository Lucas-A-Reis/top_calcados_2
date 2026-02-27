<?php

use App\Models\Usuario;
require_once '../../includes/outros/config.php';
require_once '../../includes/outros/appException.php';
require_once '../../src/database/conecta.php';
require_once '../../src/helpers/funcoes_uteis.php';
require_once '../../src/services/usuarioServico.php';
require_once '../../src/models/usuario.php';

try {
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        throw new AppException('Método não permitido', 'error', 405);
    }

    validarCaptcha();

    if(empty($token)){
        throw new AppException('É necessário preencher o captcha para prosseguir', 'warning', 422);
    }

    if(!$atributos['success']){
        throw new AppException('Houve um erro ao verificar o captcha, tente novamente.', 'error');
    }

    $usuario = new Usuario();

} catch (\Throwable $th) {
    
}
