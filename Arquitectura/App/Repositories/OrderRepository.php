<?php declare (strict_types = 1);
namespace App\Repositories;

use App\Models\Order;
use Kodoti\Database\dbProvider;

class OrderRepository
{
    private $_db;

    public function __construct()
    {
        $this->_db = dbProvider::get();
    }

    public function find(int $id): ?Order
    {
        $result = null;

        $query = 'select * from orders where id = :id';
        $stm = $this->_db->prepare($query);

        $stm->execute(['id' => $id]);

        return $stm->fetchObject('\\App\\Models\\Order');        
    }

    public function add(Order &$model): void
    //Se puede retornar el último id o pasarlo por referencia, si se trabaja por referencia todos los add
    //deben ser por referencia, definir un estándar para programar.
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

        $model->setId(intval($this->_db->lastInsertId())); 
    }
}
