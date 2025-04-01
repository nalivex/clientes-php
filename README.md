# 🛍️ Sistema Backend

<div align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white">
  <img src="https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white">
</div>

## 📋 Índice
- [Visão Geral](#-visão-geral)
- [Funcionalidades](#-funcionalidades)
- [Dependencias](#-depedências)
- [Instalação](#-instalação)

## 🌟 Visão Geral
  Sistema de API.

## ✨ Funcionalidades
- Listagem de clientes 
- Cadastro de novos clientes

## ✨ Dependências
- PHP >8
- Compose

## 🚀 Instalação

```bash
# Clone o repositório
git clone git@github.com:nalivex/clientes-php.git

# Acesse a pasta do projeto
cd clientes-php

# Instale as dependências
compose install
```

## 🛠 Usar
```bash
# Iniciar Projeto
php -S localhost:8000


# Rodar migrations
php database/migrations/create_database.php           
php database/migrations/001_create_table_users.php           
php database/migrations/002_create_table_logs.php           

```

### Descrição das Rotas:

`POST api/public/clientes`  
- **Função**: Cadastra um novo cliente  
- **Body**: `{
		"nome": "Ana Dias",
		"email": "cliente@cliente.com",
		"telefone": "(11) 9999-8888"
	}`
- **Retorno**: Cliente criado ou mensagem de erro  

`GET api/public/clientes`  
- **Função**: Lista todos os clientes cadastrados  
- **Retorno**: Array de clientes `[
	{
		"id": 1,
		"nome": "João Silva",
		"email": "joao@exemplo.com",
		"telefone": "(11) 9999-8888",
		"data_cadastro": "2025-03-31 17:17:56.050143"
	},
	{
		"id": 2,
		"nome": "Maria Santos",
		"email": "maria@exemplo.com",
		"telefone": "(21) 7777-6666",
		"data_cadastro": "2025-03-31 17:17:56.050143"
	}
]`  
