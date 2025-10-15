<?php
declare(strict_types=1);

namespace App\Application;

use App\Contracts\ProductRepository;
use App\Contracts\ProductValidator;

final class ProductService
{
    private ProductRepository $repo;
    private ProductValidator $validator;

    public function __construct(ProductRepository $repo, ProductValidator $validator)
    {
        $this->repo = $repo;
        $this->validator = $validator;
    }

    public function create(array $input)
    {
        $result = $this->validator->validate($input);
        if (!$result['valid']) {
            return false;
        }

        $price = (float) $input['price'];
        $id = $this->repo->nextId();

        $product = [
            'id' => $id,
            'name' => trim((string) $input['name']),
            'price' => $price,
        ];

        $this->repo->save($product);
        return $product;
    }

    public function list(): array
    {
        return $this->repo->findAll();
    }
}
