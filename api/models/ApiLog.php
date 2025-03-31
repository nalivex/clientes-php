<?php
class ApiLog {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($data) {
        $query = "INSERT INTO api_logs (url, status_code, response_body) 
                 VALUES (:url, :status_code, :response_body) 
                 RETURNING id";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':url' => $data['url'],
            ':status_code' => $data['status_code'],
            ':response_body' => json_encode($data['response_body'])
        ]);
        
        return $stmt->fetchColumn();
    }
}