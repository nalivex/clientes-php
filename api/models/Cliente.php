<?php
class Cliente {
    protected $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all() {
        $query = $this->db->query("SELECT * FROM users");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = $this->db->prepare(
            "INSERT INTO users (nome, email, telefone) VALUES (:nome, :email, :telefone) RETURNING *"
        );
        $query->execute($data);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    public function oneEmail($email) {
			$query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute([':email' => $email]);
        
        return $query->fetch(PDO::FETCH_ASSOC);
	}
}