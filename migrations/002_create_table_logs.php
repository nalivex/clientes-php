<?php

require_once 'api/core/Database.php';

try {
    $pdo = Database::connect();

    $sql = "CREATE TABLE IF NOT EXISTS api_logs (
			id SERIAL PRIMARY KEY,
			url TEXT NOT NULL,
			status_code INTEGER NOT NULL,
			response_body JSONB,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($sql);
    echo "Tabela 'api_logs' criada com sucesso!\n";
} catch (PDOException $e) {
    echo "Erro ao criar tabela: " . $e->getMessage();
}
