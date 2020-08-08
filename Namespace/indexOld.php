<?php
require_once 'Kodoti/Provider/MySql/database.php';
require_once 'Kodoti/Provider/MSSQL/database.php';
require_once 'Kodoti/Helpers/ivaHelper.php';
require_once 'Kodoti/Helpers/mathHelper.php';

/*Para instanciar las clases se debe hacer uso de todo el espacio de nombre, dependiendo de la 
clase. Hay 2 formas para instanciar, haciendo uso de la función use o directamente instanciando
la clase con todo el espacio de nombre, aunque esta última no es muy recomendada*/

//$obj = new Kodoti\Provider\MySql\database(); -> Útil pero no muy recomendada

/*use Kodoti\Provider\MySql\database;
$obj = new database();
var_dump($obj);*/

/*Ahora la forma para utilizar las 2 clases database es haciendo uso del namespace y un alias para
evitar errores, de la siguiente manera:*/

use Kodoti\Provider\MySql\database as MySql,
    Kodoti\Provider\MSSQL\database as MSSQL; 
    /*Otro uso que se le da al alias, es reducir el tamaño de las clases si son muy largos*/

$obj = new MySql();
$obj1 = new MSSQL();

var_dump($obj);
var_dump($obj1);

use Kodoti\Helpers\{ivaHelper as Iva, mathHelper as Math}; //Permite elegir diferentes clases de un mismo namespace

var_dump(Iva::calculate(100));
var_dump(Math::calculate());