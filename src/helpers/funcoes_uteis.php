<?php
function sanitizar($valor, $tipo, $substrato_do_numero = null)
{

    $valor = trim($valor);

    switch ($tipo) {

        case 'string':
            return filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS);

        case 'email':
            $email_limpo = filter_var($valor, FILTER_SANITIZE_EMAIL);
            if (!filter_var($email_limpo, FILTER_VALIDATE_EMAIL)) {
                throw new AppException('E-mail inválido', 'warning');
            }
            return $email_limpo;

        case 'telefone':
            return preg_replace('/[^0-9]/', '', $valor);

        case 'float':
            $float_limpo =  filter_var($valor, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if (!filter_var($float_limpo, FILTER_VALIDATE_FLOAT)) {
                throw new AppException('O preço informado não é um número decimal válido', 'warning');
            }
            return (float)$float_limpo;

        case 'int':
            $int_limpo = filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
            if (!filter_var($int_limpo, FILTER_VALIDATE_INT) && $valor !== "0"){
                throw new AppException( $substrato_do_numero.' informado não é um número decimal válido', 'warning');
            }
            return (int)$int_limpo;

        case 'none':
            return $valor;

        default:
            return filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}

function validarCaptcha()
{
    $token = $_POST['g-recaptcha-response'];
    $chave = $_ENV['RECAPTCHA_SECRET_KEY'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$chave&response=$token";
    $resposta = file_get_contents($url);
    $atributos = json_decode($resposta, true);
}
