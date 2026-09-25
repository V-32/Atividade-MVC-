<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Livro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h1>Cadastrar Novo Livro</h1>

    <?php if (!empty($erros)): ?>
        <div class="erro">
            <ul>
                <?php foreach ($erros as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?acao=criar">
        <div class="form-group">
            <label>Título *</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label>Autor *</label>
            <input type="text" name="autor" value="<?= htmlspecialchars($_POST['autor'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label>Gênero</label>
            <input type="text" name="genero" value="<?= htmlspecialchars($_POST['genero'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Ano de Publicação *</label>
            <input type="number" name="ano_publicacao" max="<?= date('Y') ?>" value="<?= htmlspecialchars($_POST['ano_publicacao'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label>Quantidade de Exemplares *</label>
            <input type="number" name="quantidade" min="0" value="<?= htmlspecialchars($_POST['quantidade'] ?? '0') ?>" required>
        </div>

        <button type="submit">Salvar</button>
        <a href="index.php">Voltar</a>
    </form>

</body>
</html>