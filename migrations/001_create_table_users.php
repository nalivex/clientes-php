<?php

require_once 'api/core/Database.php';

try {
    $pdo = Database::connect();

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(150) UNIQUE NOT NULL,
        telefone VARCHAR(255) NOT NULL,
        data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($sql);
    echo "Tabela 'users' criada com sucesso!\n";
} catch (PDOException $e) {
    echo "Erro ao criar tabela: " . $e->getMessage();
}
