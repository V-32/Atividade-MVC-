<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Acervo de Livros</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 6px 12px; text-decoration: none; color: #fff; background-color: #28a745; border-radius: 4px; border: none; cursor: pointer; }
        .btn-danger { background-color: #dc3545; }
        .btn-edit { background-color: #ffc107; color: #000; }
        .indisponivel { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <h1>Acervo de Livros</h1>

    <div style="margin-bottom: 15px;">
        <a href="index.php?acao=criar" class="btn">Cadastrar Novo Livro</a>
    </div>

   
    <form method="GET" action="index.php">
        <input type="text" name="busca" placeholder="Buscar por título ou autor..." value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>">
        <button type="submit">Buscar</button>
        <?php if (!empty($_GET['busca'])): ?>
            <a href="index.php">Limpar Busca</a>
        <?php endif; ?>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>Ano</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($livros)): ?>
                <tr>
                    <td colspan="7">Nenhum livro encontrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($livros as $l): ?>
                    <tr>
                        <td><?= htmlspecialchars((string)$l['id']) ?></td>
                        <td><?= htmlspecialchars($l['titulo']) ?></td>
                        <td><?= htmlspecialchars($l['autor']) ?></td>
                        <td><?= htmlspecialchars($l['genero'] ?? '-') ?></td>
                        <td><?= htmlspecialchars((string)$l['ano_publicacao']) ?></td>
                        <td>
                            <?php if ((int)$l['quantidade'] === 0): ?>
                                <span class="indisponivel">Indisponível</span>
                            <?php else: ?>
                                <?= htmlspecialchars((string)$l['quantidade']) ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?acao=editar&id=<?= htmlspecialchars((string)$l['id']) ?>" class="btn btn-edit">Editar</a>
                            
                           
                            <form method="POST" action="index.php?acao=deletar" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                                <input type="hidden" name="id" value="<?= htmlspecialchars((string)$l['id']) ?>">
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>