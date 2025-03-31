<?php
class Database {
    public static function connect() {
        return new PDO(
            'pgsql:host=127.0.0.1;dbname=clientess',
            'postgres',
            'root'
        );
    }
}