<?php declare (strict_types = 1);
namespace App\Services;

use App\Models\Order;
use Kodoti\Container;
use Kodoti\Database\dbProvider;
use App\Repositories\UserRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\OrderDetailRepository;

class OrderService
{
    private $_db;

    private $_productRepository;
    private $_userRepository;
    private $_orderRepository;
    private $_orderDetailRepository;
    private $_logger;

    public function __construct()
    {
        $this->_db = dbProvider::get();

        $this->_productRepository = new ProductRepository;
        $this->_userRepository = new UserRepository;
        $this->_orderRepository = new OrderRepository;
        $this->_orderDetailRepository = new OrderDetailRepository;
        $this->_logger = Container::get('logger');
    }

    public function getOrder(int $id): ?Order
    {
        $result = null;

        try {
            $data = $this->_orderRepository->find($id);

            if ($data) {
                $result = $data;

                // Cliente
                $result->setClient($this->_userRepository->find($result->getUserId()));

                // Usuario que creó la orden
                $result->setCreater($this->_userRepository->find($result->getCreaterId()));

                // Detalle de la orden
                $result->setDetail($this->getDetail($result->getId()));
            }
        } catch (\Throwable $th) {
            $this->_logger->error($th->getMessage());
        }

        return $result;
    }

    private function getDetail(int $orderId): array
    {
        $result = $this->_orderDetailRepository->findAllByOrderId($orderId);

        foreach ($result as $item) {
            $item->setProduct($this->_productRepository->find($item->getProductId()));
        }

        return $result;
    }

    public function createOrder(Order $model): void
    {
        try {
            $this->_db->beginTransaction();

            $this->_logger->info('Comenzó creación de orden');

            $this->prepareOrdenCreation($model);

            $this->_logger->info('Se preparó el modelo para la nueva orden');            

            $this->_orderRepository->add($model);

            $this->_logger->info('Se creó la nueva orden');

            $this->_logger->info('Se asoció el ID ' . strval($model->getId()) . ' a la nueva orden');

            $this->_orderDetailRepository->addByOrderId($model->getId(), $model->getDetail());

            $this->_logger->info('Se creó el detalle de la orden');

            $this->_db->commit();

            $this->_logger->info('Finalizó la creación de la orden');

        } catch (\Throwable $th) {
            $this->_logger->error($th->getMessage());

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
}
