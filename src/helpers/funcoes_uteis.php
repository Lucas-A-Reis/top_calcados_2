<?php
function sanitizar($valor, $tipo)
{
    switch ($tipo) {
        case 'string':
            return filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS);

        case 'email':
            return filter_var($valor, FILTER_SANITIZE_EMAIL);

        case 'telefone':
            return preg_replace('/[^0-9]/', '', $valor);

        case 'float':
            return filter_var($valor, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        case 'int':
            return filter_var($valor, FILTER_SANITIZE_NUMBER_INT);

        case 'none':
            return $valor;

        default:
            return filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}
