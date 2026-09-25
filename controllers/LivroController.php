<?php

require_once __DIR__ . '/../models/Livro.php';

class LivroController {
    private $model;

    public function __construct() {
        $this->model = new Livro();
    }

  
    public function index() {
        $busca = $_GET['busca'] ?? '';
        $livros = $this->model->listarTodos($busca);
        require __DIR__ . '/../views/livro/index.php';
    }

   
    public function criar() {
        $erros = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $erros = $this->model->validarData($_POST);

            if (empty($erros)) {
                $this->model->criar($_POST);
                header('Location: index.php');
                exit;
            }
        }
        require __DIR__ . '/../views/livro/criar.php';
    }

    
    public function editar() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php');
            exit;
        }

        $livro = $this->model->buscarPorId($id);
        if (!$livro) {
            header('Location: index.php');
            exit;
        }

        $erros = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $erros = $this->model->validarData($_POST);

            if (empty($erros)) {
                $this->model->atualizar($id, $_POST);
                header('Location: index.php');
                exit;
            }
            $livro = array_merge($livro, $_POST);
        }

        require __DIR__ . '/../views/livro/editar.php';
    }

  
    public function deletar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $this->model->deletar($id);
            }
        }
        header('Location: index.php');
        exit;
    }
}