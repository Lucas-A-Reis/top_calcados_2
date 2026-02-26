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
