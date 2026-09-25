<?php

require_once __DIR__ . '/controllers/LivroController.php';

$controller = new LivroController();
$acao = $_GET['acao'] ?? 'index';

switch ($acao) {
    case 'criar':
        $controller->criar();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'deletar':
        $controller->deletar();
        break;
    case 'index':
    default:
        $controller->index();
        break;
}