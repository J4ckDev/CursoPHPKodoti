<?php declare (strict_types = 1);
namespace App\Services;

use App\Models\User;
use App\Models\Order;
use Kodoti\Database\dbProvider;

class OrderService
{
    private $_db;

    public function __construct()
    {
        $this->_db = dbProvider::get();
    }

    public function getOrder(int $id) : ?Order
    {
        $result=null;

        try {
            $query = 'select * from orders where id = :id';
            $stm = $this->_db->prepare($query);

            //Ejecutar consulta
            $stm->execute(['id' => $id]);

            //Obtener datos
            $data = $stm->fetchObject('\\App\\Models\\Order');

            if ($data) { //Esto es para asegurarse de que si hay datos con ese id.
                $result = $data;

                // Cliente
                $result->setClient($this->getUser($result->getUserId()));
                
                // Usuario que creó la orden
                $result->setCreater($this->getUser($result->getCreaterId()));

                // Detalle de la orden
                $result->setDetail($this->getDetail($result->getId()));
            }
        } catch (\Throwable $th) {
            print $th->getMessage();;
        }

        return $result;
    }

    private function getDetail(int $orderId) : Array
    {
        $query = 'select * from order_detail where order_id = :order_id';
        $stm = $this->_db->prepare($query);

        //Ejecutar consulta
        $stm->execute(['order_id' => $orderId]);

        //Obtener datos
        $result = $stm->fetchAll(\PDO::FETCH_CLASS, '\\App\\Models\\OrderDetail');

        foreach ($result as $item) {
            $query = 'select * from products where id = :product_id';
            $stm = $this->_db->prepare($query);

            //Ejecutar consulta
            $stm->execute(['product_id' => $item->getProductId()]);

            $item->setProduct($stm->fetchObject('\\App\\Models\\product'));
        }

        return $result;
    }

    private function getUser(int $id) : User
    {
        $query = 'select * from users where id = :id';
        $stm = $this->_db->prepare($query);

        //Ejecutar consulta
        $stm->execute(['id' => $id]);

        //Obtener datos
        $result = $stm->fetchObject('\\App\\Models\\User');
        unset($result->password);

        return $result;
    }

    public function createOrder(Order $model): void
    {
        try {
            /*Transacciones
              Solo funciona con InnoDB. Las transacciones nos permiten que en caso de cualquier error
              la base de datos mantenga su integridad al revertir los cambios que se hayan alcanzado
              a realizar. El commit es cuando todo sale bien y la base de datos acepta los cambios y
              rollback es para revertir los cambios en caso de que se haya obtenido un error. */

            //Iniciar transacción
            $this->_db->beginTransaction();
            
            // Preparar la creación de la orden
            $this->prepareOrdenCreation($model);

            // Crear la orden
            $this->orderCreate($model);

            // Crear detalle de la orden
            $this->orderDetailCreate($model);

            //Commit transaction
            $this->_db->commit();

        } catch (\Throwable $th) {
            //Ver detalle de errores
            print $th->getMessage();

            //En caso de un error, se revierten los cambios de la transacción
            $this->_db->rollBack();
        }
    }

    private function prepareOrdenCreation(Order &$model): void
    {
        $now = date('Y-m-d H:i:s');
        foreach ($model->getDetail() as $item) {
            $item->setTotal($item->getPrice() * $item->getQuantity());
            $item->setCreatedAt($now);
            $item->setUpdatedAt($now);

            $model->setTotal($item->getTotal());
        }

        $model->setCreatedAt($now);
        $model->setUpdatedAt($now);
    }

    private function orderCreate(Order &$model): void
    {
        $query = 'insert into orders(user_id, total, creater_id, created_at, updated_at)
        values(:userId, :total, :createrId, :createdAt, :updatedAt)';

        $stm = $this->_db->prepare($query);

        $stm->execute([
            'userId' => $model->getUserId(),
            'total' => $model->getTotal(),
            'createrId' => $model->getCreaterId(),
            'createdAt' => $model->getCreatedAt(),
            'updatedAt' => $model->getUpdatedAt(),
        ]);

        $model->setId(intval($this->_db->lastInsertId())); //Retorna el último id creado o generado
        //var_dump($model->getId());
    }

    private function orderDetailCreate(Order $model): void
    {
        foreach ($model->getDetail() as $item) {
            $query = 'insert into order_detail(order_id, product_id, quantity, price, total, created_at, updated_at)
            values(:order_id, :product_id, :quantity, :price, :total, :created_at, :updated_at)';

            $stm = $this->_db->prepare($query);

            $stm->execute([
                'order_id' => $model->getId(),
                'product_id' => $item->getProductId(),
                'quantity' => $item->getQuantity(),
                'price' => $item->getPrice(),
                'total' => $item->getTotal(),
                'created_at' => $item->getCreatedAt(),
                'updated_at' => $item->getUpdatedAt()
            ]);
        }
    }
}
