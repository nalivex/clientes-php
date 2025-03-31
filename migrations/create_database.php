<?php
$host = "127.0.0.1";
$user = "postgres";
$pass = "root";
$dbname = "clientess";

try {
    $pdo = new PDO("pgsql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE $dbname");
    echo "Banco de dados '$dbname' criado com sucesso!\n";
} catch (PDOException $e) {
    echo "Erro ao criar banco de dados: " . $e->getMessage();
}
?>
