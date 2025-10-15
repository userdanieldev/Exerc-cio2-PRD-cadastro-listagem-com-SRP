<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <title>Cadastro de Produto</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    label { display:block; margin-top:10px;}
    input[type="text"], input[type="number"] { width:300px; padding:6px; }
    button { margin-top:10px; padding:8px 12px; }
  </style>
</head>
<body>
  <h1>Cadastrar Produto</h1>
  <form action="create.php" method="post" novalidate>
    <label for="name">Nome</label>
    <input id="name" name="name" type="text" required minlength="2" maxlength="100" />
    <label for="price">Preço</label>
    <input id="price" name="price" type="number" step="0.01" min="0" required />
    <button type="submit">Criar</button>
  </form>
  <p><a href="products.php">Ver produtos cadastrados</a></p>
</body>
</html>
