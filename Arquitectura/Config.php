<?php
define('__CONFIG__',[
    'db' => [
        'host' => 'mysql:host=localhost;dbname=kodoti;charset=utf8',
        'user' => 'root',
        'pass' => ''
    ],
    'log' => [
        'path' => 'log/',
        'channel' => 'kodoti'
    ]
]);
//log es para iniciar monolog, en path se pone la ubicación donde se guardan los archivos y en
//channel es el prefijo que le da.