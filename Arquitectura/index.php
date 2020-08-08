<?php
require_once 'vendor/autoload.php';
require_once 'Config.php';

use App\Models\Order;
use Kodoti\Container;
use App\Models\OrderDetail;
use App\Services\OrderService;

Container::set('logger', function () {
    $logger = new \Monolog\Logger(__CONFIG__['log']['channel']);
    //Aunque se puede usar con diferentes formas para guardar los registros, en este caso se hará con
    //archivos de texto plano.
    $file_handler = new \Monolog\Handler\StreamHandler(__CONFIG__['log']['path'] . date('Ymd') . '.log');
    $logger->pushHandler($file_handler);

    return $logger; //Retorna la instancia de monolog
});

/*
$logger = Container::get('logger');
$logger->info('Project Started');
Revisar más en la documentación oficial
*/

$service = new OrderService;

//Cabecera de la orden
$model = new Order();

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
$service->createOrder($model);