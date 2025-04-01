<?php
require_once 'api/core/Database.php';

function runMigrations($migrationsDirectory)
{
    if (!is_dir($migrationsDirectory)) {
        echo "Diretório de migrations não encontrado.\n";
        return;
    }

    $migrationFiles = glob($migrationsDirectory . '/*.php');

    sort($migrationFiles);

    foreach ($migrationFiles as $migrationFile) {
        echo "Executando: " . basename($migrationFile) . "\n";
        require_once $migrationFile;
    }
}

$migrationsDirectory = 'migrations';

runMigrations($migrationsDirectory);
