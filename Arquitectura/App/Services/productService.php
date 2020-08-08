<?php declare (strict_types = 1);
namespace App\Services;

use Kodoti\Container;
use App\Models\product;
use App\Repositories\ProductRepository;

class productService
{
    private $_productRepository;
    private $_logger;

    public function __construct()
    {
        $this->_productRepository = new ProductRepository;
        $this->_logger = Container::get('logger');
    }

    public function getAll(): array
    {
        $result = [];

        try {
            $result = $this->_productRepository->findAll();
        } catch (\Throwable $th) {
            $this->_logger->error($th->getMessage());
        }

        return $result;
    }

    public function getProduct(int $id): ?product
    {
        $result = null;

        try {
            $result = $this->_productRepository->find($id);
        } catch (\Throwable $th) {
            $this->_logger->error($th->getMessage());
        }

        return $result;
    }

    public function createProduct(product $model): void
    {
        try {
            $result = $this->_productRepository->create($model);
        } catch (\Throwable $th) {
            $this->_logger->error($th->getMessage());
        }
    }

    public function updateProduct(product $model): void
    {
        try {
            $result = $this->_productRepository->update($model);
        } catch (\Throwable $th) {
            $this->_logger->error($th->getMessage());
        }
    }

    public function deleteProduct(int $id): void
    {
        try {
            $result = $this->_productRepository->remove($id);
        } catch (\Throwable $th) {
            $this->_logger->error($th->getMessage());
        }
    }

}
