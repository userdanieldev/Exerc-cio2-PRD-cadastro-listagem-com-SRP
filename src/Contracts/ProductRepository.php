<?php
declare(strict_types=1);

namespace App\Contracts;

interface ProductRepository
{
    public function save(array $product): void;
    public function findAll(): array;
    public function nextId(): int;
}