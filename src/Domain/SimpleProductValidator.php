<?php
declare(strict_types=1);

namespace App\Domain;

use App\Contracts\ProductValidator;

final class SimpleProductValidator implements ProductValidator
{
    public function validate(array $input): array
    {
        $errors = [];
        $name = $input['name'] ?? '';
        $priceRaw = $input['price'] ?? null;
        $name = trim((string) $name);
        $len = mb_strlen($name);

        if ($name === '') {
            $errors[] = 'O campo name é obrigatório.';
        } elseif ($len < 2) {
            $errors[] = 'O campo name deve ter pelo menos 2 caracteres.';
        } elseif ($len > 100) {
            $errors[] = 'O campo name deve ter no máximo 100 caracteres.';
        }

        if ($priceRaw === null || $priceRaw === '') {
            $errors[] = 'O campo price é obrigatório.';
        } elseif (!is_numeric($priceRaw)) {
            $errors[] = 'O campo price deve ser numérico.';
        } else {
            $price = (float) $priceRaw;
            if ($price < 0) {
                $errors[] = 'O campo price não pode ser negativo.';
            }
        }

        return [
            'valid' => count($errors) === 0,
            'errors' => $errors,
        ];
    }
}
