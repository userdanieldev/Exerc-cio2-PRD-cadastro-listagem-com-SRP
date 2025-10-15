<?php
declare(strict_types=1);

namespace App\Infra;

use App\Contracts\ProductRepository;

final class FileProductRepository implements ProductRepository
{
    private string $file;

    public function __construct(string $storagePath)
    {
        $this->file = rtrim($storagePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'products.txt';
        if (!file_exists($this->file)) {
            file_put_contents($this->file, '');
        }
    }

    public function save(array $product): void
    {
        $line = json_encode($product, JSON_UNESCAPED_UNICODE) . PHP_EOL;
        $fp = fopen($this->file, 'a');
        if ($fp === false) {
            throw new \RuntimeException('Erro ao abrir o arquivo.');
        }
        if (!flock($fp, LOCK_EX)) {
            fclose($fp);
            throw new \RuntimeException('Erro ao bloquear o arquivo.');
        }
        fwrite($fp, $line);
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    public function findAll(): array
    {
        $products = [];
        $fp = fopen($this->file, 'r');
        if ($fp === false) {
            return [];
        }
        if (!flock($fp, LOCK_SH)) {
            fclose($fp);
            return [];
        }

        while (($line = fgets($fp)) !== false) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }
            $data = json_decode($line, true);
            if (is_array($data)) {
                $products[] = $data;
            }
        }

        flock($fp, LOCK_UN);
        fclose($fp);
        return $products;
    }

    public function nextId(): int
    {
        $lastId = 0;
        $fp = fopen($this->file, 'r');
        if ($fp === false) {
            return 1;
        }
        if (!flock($fp, LOCK_SH)) {
            fclose($fp);
            return 1;
        }

        while (($line = fgets($fp)) !== false) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }
            $data = json_decode($line, true);
            if (is_array($data) && isset($data['id']) && is_numeric($data['id'])) {
                $id = (int) $data['id'];
                if ($id > $lastId) {
                    $lastId = $id;
                }
            }
        }

        flock($fp, LOCK_UN);
        fclose($fp);
        return $lastId + 1;
    }
}
