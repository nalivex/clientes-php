<?php
require_once __DIR__ . '/../models/Cliente.php';

class ClientesController {
	private $db;

	public function __construct() {
			$this->db = Database::connect();
	}
	
    public function list() {
        header('Content-Type: application/json');
        echo json_encode((new Cliente())->all());
    }

    public function create() {
			header('Content-Type: application/json');
        
			try {
					$data = json_decode(file_get_contents('php://input'), true);
					
					if (empty($data['nome']) || empty($data['email'])) {
							throw new Exception('Nome e email são obrigatórios');
					}
					
					$clienteModel = new Cliente();
					
					if(!empty($clienteModel->oneEmail($data['email']))){
							throw new Exception('Email existente!');
					}
					
					$stmt = ([
						'nome' => $data['nome'],
						'email' => $data['email'],
						'telefone' => $data['telefone']
				]);
				
				$newCliente = $clienteModel->create($stmt);
					
					$clienteId = $newCliente['id'];
					
					$apiResponse = $this->callExternalApi();
					
					$this->logApiCall($apiResponse);

					http_response_code(201);
					echo json_encode([
							'success' => true,
							'cliente_id' => $clienteId
					]);
					
			} catch (Exception $e) {
					http_response_code(400);
					echo json_encode(['error' => $e->getMessage()]);
			}
	}

	private function callExternalApi() {
			$apiUrl = "https://jsonplaceholder.typicode.com/posts";
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $apiUrl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			
			return [
					'url' => $apiUrl,
					'status_code' => $statusCode,
					'body' => json_decode($response, true)
			];
	}

	private function logApiCall($data) {
			$stmt = $this->db->prepare(
					"INSERT INTO api_logs (url, status_code, response_body) 
					 VALUES (:url, :status_code, :response)"
			);
			$stmt->execute([
					':url' => $data['url'],
					':status_code' => $data['status_code'],
					':response' => json_encode($data['body'])
			]);
	}
}