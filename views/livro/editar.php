<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h1>Editar Livro</h1>

    <?php if (!empty($erros)): ?>
        <div class="erro">
            <ul>
                <?php foreach ($erros as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?acao=editar&id=<?= htmlspecialchars((string)$livro['id']) ?>">
        <div class="form-group">
            <label>Título *</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($livro['titulo'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label>Autor *</label>
            <input type="text" name="autor" value="<?= htmlspecialchars($livro['autor'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label>Gênero</label>
            <input type="text" name="genero" value="<?= htmlspecialchars($livro['genero'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Ano de Publicação *</label>
            <input type="number" name="ano_publicacao" max="<?= date('Y') ?>" value="<?= htmlspecialchars((string)$livro['ano_publicacao'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label>Quantidade de Exemplares *</label>
            <input type="number" name="quantidade" min="0" value="<?= htmlspecialchars((string)$livro['quantidade'] ?? '0') ?>" required>
        </div>

        <button type="submit">Atualizar</button>
        <a href="index.php">Voltar</a>
    </form>

</body>
</html>