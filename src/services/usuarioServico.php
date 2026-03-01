<?php
function buscarUsuarioPorEmail($pdo, $email)
{
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    return $stmt->fetch();
}

function verificarAdmin($pdo, $email)
{
    $sql = "SELECT tipo FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    return $stmt->fetch();
}

function inserirUsuario($pdo, Usuario $usuario) {

    try{
    $sql = 'INSERT INTO usuario (nome, email, senha, telefone)
            VALUES (:nome, :email, :senha, :telefone)';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome', $usuario->getNome());
    $stmt->bindValue(':email', $usuario->getEmail());
    $hash = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
    $stmt->bindValue(':senha', $hash);
    $stmt->bindValue(':telefone', $usuario->getTelefone());
    $stmt->execute();

    }catch(PDOException $e){
        if($e->getCode() == 23000 && strpos($e->getMessage(), 'email') !== false){
            throw new AppException("Parece que o e-mail fornecido já está cadastrado no sistema, tente novamente com outro endereço de e-mail", "warning", 422);
        } else {
            throw new AppException('Erro técnico no processamento dos dados, tente novamente mais tarde', 'error', 500);
        }
    }
    
}