<?php

require_once __DIR__ . '/../config/Database.php';

class Livro {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Regra de Validação
    public function validarData($data) {
        $erros = [];

        // Título e autor não podem ser vazios
        if (empty(trim($data['titulo'] ?? ''))) {
            $erros[] = "O título é obrigatório.";
        }
        if (empty(trim($data['autor'] ?? ''))) {
            $erros[] = "O autor é obrigatório.";
        }

        // Ano não pode ser maior que o ano atual
        $anoAtual = (int)date('Y');
        if (empty($data['ano_publicacao']) || !is_numeric($data['ano_publicacao']) || (int)$data['ano_publicacao'] > $anoAtual) {
            $erros[] = "O ano de publicação é inválido ou maior que o ano atual ({$anoAtual}).";
        }

        // Quantidade não pode ser negativa
        if (!isset($data['quantidade']) || !is_numeric($data['quantidade']) || (int)$data['quantidade'] < 0) {
            $erros[] = "A quantidade de exemplares não pode ser negativa.";
        }

        return $erros;
    }

    // Listar todos os livros ou filtrar por termo
    public function listarTodos($busca = '') {
        if (!empty($busca)) {
            $stmt = $this->conn->prepare(
                "SELECT * FROM livros WHERE titulo LIKE :busca OR autor LIKE :busca ORDER BY id DESC"
            );
            $termo = "%{$busca}%";
            $stmt->bindParam(':busca', $termo, PDO::PARAM_STR);
        } else {
            $stmt = $this->conn->prepare("SELECT * FROM livros ORDER BY id DESC");
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Buscar livro por ID
    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM livros WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Cadastrar novo livro
    public function criar($data) {
        $stmt = $this->conn->prepare(
            "INSERT INTO livros (titulo, autor, genero, ano_publicacao, quantidade) 
             VALUES (:titulo, :autor, :genero, :ano_publicacao, :quantidade)"
        );

        return $stmt->execute([
            ':titulo' => trim($data['titulo']),
            ':autor' => trim($data['autor']),
            ':genero' => trim($data['genero'] ?? ''),
            ':ano_publicacao' => (int)$data['ano_publicacao'],
            ':quantidade' => (int)$data['quantidade']
        ]);
    }

    // Atualizar livro existente
    public function atualizar($id, $data) {
        $stmt = $this->conn->prepare(
            "UPDATE livros 
             SET titulo = :titulo, autor = :autor, genero = :genero, ano_publicacao = :ano_publicacao, quantidade = :quantidade 
             WHERE id = :id"
        );

        return $stmt->execute([
            ':id' => (int)$id,
            ':titulo' => trim($data['titulo']),
            ':autor' => trim($data['autor']),
            ':genero' => trim($data['genero'] ?? ''),
            ':ano_publicacao' => (int)$data['ano_publicacao'],
            ':quantidade' => (int)$data['quantidade']
        ]);
    }

    // Excluir livro
    public function deletar($id) {
        $stmt = $this->conn->prepare("DELETE FROM livros WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}