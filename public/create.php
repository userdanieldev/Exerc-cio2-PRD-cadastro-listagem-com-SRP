<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Application\ProductService;
use App\Domain\SimpleProductValidator;
use App\Infra\FileProductRepository;

$storagePath = __DIR__ . '/../storage';

$repo = new FileProductRepository($storagePath);
$validator = new SimpleProductValidator();
$service = new ProductService($repo, $validator);

$input = [
    'name' => $_POST['name'] ?? '',
    'price' => $_POST['price'] ?? '',
];

$product = $service->create($input);

if ($product === false) {
    $validation = $validator->validate($input);
    http_response_code(422);
    ?>
    <!doctype html>
    <html lang="pt-BR">
    <head><meta charset="utf-8"/><title>Erro</title></head>
    <body>
      <h1>Erro ao cadastrar produto</h1>
      <ul>
        <?php foreach ($validation['errors'] as $err): ?>
          <li><?= htmlspecialchars($err, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></li>
        <?php endforeach; ?>
      </ul>
      <p><a href="index.php">Voltar</a></p>
    </body>
    </html>
    <?php
    exit;
}

http_response_code(201);
?>
<!doctype html>
<html lang="pt-BR">
<head><meta charset="utf-8"/><title>Criado</title></head>
<body>
  <h1>Produto criado com sucesso</h1>
  <p>ID: <?= htmlspecialchars((string)$product['id']) ?></p>
  <p>Nome: <?= htmlspecialchars($product['name']) ?></p>
  <p>Preço: <?= number_format((float)$product['price'], 2, ',', '.') ?></p>
  <p><a href="products.php">Ver produtos</a> | <a href="index.php">Cadastrar outro</a></p>
</body>
</html>
