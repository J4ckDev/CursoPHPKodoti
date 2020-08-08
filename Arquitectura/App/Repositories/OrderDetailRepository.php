<?php declare (strict_types = 1);
namespace App\Repositories;

use Kodoti\Database\dbProvider;

class OrderDetailRepository
{
    private $_db;

    public function __construct()
    {
        $this->_db = dbProvider::get();
    }

    public function findAllByOrderId(int $order_id): Array
    {
        $query = 'select * from order_detail where order_id = :order_id';
        $stm = $this->_db->prepare($query);

        $stm->execute(['order_id' => $order_id]);

        return $stm->fetchAll(\PDO::FETCH_CLASS, '\\App\\Models\\OrderDetail');        
    }

    public function addByOrderId(int $order_id, Array $model): void
    {
        foreach ($model as $item) {
            $query = 'insert into order_detail(order_id, product_id, quantity, price, total, created_at, updated_at)
            values(:order_id, :product_id, :quantity, :price, :total, :created_at, :updated_at)';

            $stm = $this->_db->prepare($query);

            $stm->execute([
                'order_id' => $order_id,
                'product_id' => $item->getProductId(),
                'quantity' => $item->getQuantity(),
                'price' => $item->getPrice(),
                'total' => $item->getTotal(),
                'created_at' => $item->getCreatedAt(),
                'updated_at' => $item->getUpdatedAt(),
            ]);
        }
    }
}
