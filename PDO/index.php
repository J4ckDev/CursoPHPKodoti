<?php
require_once 'vendor/autoload.php';

/*use App\Services\productService;
use App\Models\product;

$service = new productService;
$model = new product;
$now = date('Y-m-d H:i:s');

$model->setId(13);
$model->setName('Guitarra Suhr Pro');
$model->setPrice(4500);
//$model->setCreatedAt($now);
$model->setUpdatedAt($now);

$service->deleteProduct($model->getId());*/

use App\Services\OrderService;
use App\Models\Order;
use App\Models\OrderDetail;

$service = new OrderService;

var_dump($service->getOrder(48));
//$service->getOrder(48);

//Todo este código se podría mejorar haciendo uso de un constructor.
//Cabecera de la orden
/*$model = new Order();

$model->setUserId(1);
$model->setCreaterId(2);

//Detalle
$detail1 = new OrderDetail();
$detail2 = new OrderDetail();

$detail1->setProductId(1);
$detail1->setPrice(2500);
$detail1->setQuantity(2);

$detail2->setProductId(4);
$detail2->setPrice(7);
$detail2->setQuantity(3);

//Agregar la orden
$model->setDetail([$detail1, $detail2]);

//Crear la orden
$service->createOrder($model);*/