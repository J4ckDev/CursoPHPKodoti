<?php declare (strict_types = 1);
namespace App\Services;

use App\Models\product;
use Kodoti\Database\dbProvider;

class productService
{
    private $_db;

    public function __construct()
    {
        $this->_db = dbProvider::get();
    }

    public function getAll(): array
    {
        $result = [];

        try {
            // Preparar consulta
            $query = 'select * from products';
            $stm = $this->_db->prepare($query);

            //Ejecutar consulta
            $stm->execute();

            //Obtener datos
            $result = $stm->fetchAll(\PDO::FETCH_CLASS, '\\App\\Models\\product'); /*El \ al inicio
        de PDO es para ignorar el namespace, si no se coloca ese caracter hay que colocar al
        inicio la línea "use PDO" para evitar errores*/

        } catch (\Throwable $th) {
            print 'Ocurrió un error con la consulta';
        }

        return $result;
    }

    public function getProduct(int $id): ?product//El ? indica que puede retornar variables nulas

    {
        $result = null;

        try {
            $query = 'select * from products where id = :id';
            $stm = $this->_db->prepare($query);

            //Ejecutar consulta
            $stm->execute(['id' => $id]);

            //Obtener datos
            $data = $stm->fetchObject('\\App\\Models\\product');

            if ($data) { //Esto es para asegurarse de que si hay datos con ese id.
                $result = $data;
            }
        } catch (\Throwable $th) {
            print 'Ocurrió un error con la consulta';
        }

        return $result;
    }

    public function createProduct(product $model): void//El ? indica que puede retornar variables nulas

    {
        try {
            $query = 'insert into products(name, price, created_at, updated_at) values (:name, :price, :created, :updated)';
            $stm = $this->_db->prepare($query);

            //Ejecutar consulta
            $stm->execute([
                'name' => $model->getName(),
                'price' => $model->getPrice(),
                'created' => $model->getCreatedAt(),
                'updated' => $model->getUpdatedAt()
            ]);
        } catch (\Throwable $th) {
            print 'Ocurrió un error con la consulta';
        }
    }

    public function updateProduct(product $model): void//El ? indica que puede retornar variables nulas

    {
        try {
            $query = 'update products set name = :name, price = :price, updated_at = :updated where id = :id';
            $stm = $this->_db->prepare($query);

            //Ejecutar consulta
            $stm->execute([
                'id' => $model->getId(),
                'name' => $model->getName(),
                'price' => $model->getPrice(),                
                'updated' => $model->getUpdatedAt()
            ]);
        } catch (\Throwable $th) {
            print 'Ocurrió un error con la consulta';
        }
    }

    public function deleteProduct(int $id): void//El ? indica que puede retornar variables nulas

    {
        try {
            $query = 'delete from products where id = :id';
            $stm = $this->_db->prepare($query);

            //Ejecutar consulta
            $stm->execute([
                'id' => $id
            ]);
        } catch (\Throwable $th) {
            print 'Ocurrió un error con la consulta';
        }
    }

}
