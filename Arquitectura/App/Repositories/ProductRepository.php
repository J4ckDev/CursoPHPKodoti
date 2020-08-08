<?php declare (strict_types = 1);
namespace App\Repositories;

use App\Models\product;
use Kodoti\Database\dbProvider;

class ProductRepository
{
    private $_db;

    public function __construct()
    {
        $this->_db = dbProvider::get();
    }

    public function find(int $id): ?product
    {
        $result = null;

        $query = 'select * from products where id = :id';
        $stm = $this->_db->prepare($query);

        $stm->execute(['id' => $id]);

        $data = $stm->fetchObject('\\App\\Models\\product');

        if ($data) {
            $result = $data;
        }

        return $result;
    }

    public function findAll(): array
    {
        $result = [];

        $query = 'select * from products';
        $stm = $this->_db->prepare($query);

        //Ejecutar consulta
        $stm->execute();

        //Obtener datos
        $result = $stm->fetchAll(\PDO::FETCH_CLASS, '\\App\\Models\\product');

        return $result;
    }

    public function add(product $model): void//Los add deberían retornar el último id generado

    {
        $query = 'insert into products(name, price, created_at, updated_at) values (:name, :price, :created, :updated)';
        $stm = $this->_db->prepare($query);

        //Ejecutar consulta
        $stm->execute([
            'name' => $model->getName(),
            'price' => $model->getPrice(),
            'created' => $model->getCreatedAt(),
            'updated' => $model->getUpdatedAt(),
        ]);
    }

    public function update(product $model): void
    {
        $query = 'update products set name = :name, price = :price, updated_at = :updated where id = :id';
        $stm = $this->_db->prepare($query);

        //Ejecutar consulta
        $stm->execute([
            'id' => $model->getId(),
            'name' => $model->getName(),
            'price' => $model->getPrice(),
            'updated' => $model->getUpdatedAt(),
        ]);
    }

    public function remove(int $id): void
    {
        $query = 'delete from products where id = :id';
        $stm = $this->_db->prepare($query);

        //Ejecutar consulta
        $stm->execute([
            'id' => $id,
        ]);
    }
}
