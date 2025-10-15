<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;
use App\Application\ProductService;

$storagePath = __DIR__ . '/../storage';

$repo = new FileProductRepository($storagePath);
$validator = new SimpleProductValidator();
$service = new ProductService($repo, $validator);

$products = $service->list();
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8"/>
  <title>Produtos</title>
  <style>
    body{font-family: Arial, sans-serif; padding:20px}
    table{border-collapse:collapse; width:100%; max-width:800px}
    th, td{border:1px solid #ddd; padding:8px; text-align:left}
    th{background:#f2f2f2}
  </style>
</head>
<body>
  <h1>Produtos cadastrados</h1>
  <p><a href="index.php">Cadastrar novo</a></p>
  <?php if (empty($products)): ?>
    <p><em>Nenhum produto cadastrado</em></p>
  <?php else: ?>
    <table>
      <thead>
        <tr><th>ID</th><th>Nome</th><th>Preço</th></tr>
      </thead>
      <tbody>
        <?php foreach ($products as $p): ?>
          <tr>
            <td><?= htmlspecialchars((string)$p['id']) ?></td>
            <td><?= htmlspecialchars((string)$p['name']) ?></td>
            <td><?= number_format((float)$p['price'], 2, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</body>
</html>
