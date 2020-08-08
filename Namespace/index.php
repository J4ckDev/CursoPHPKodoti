<?php

error_reporting(E_ALL);
set_error_handler(function ($severidad, $mensaje, $fichero, $línea) {
  if (!(error_reporting() & $severidad)) {
    return;
  }

  throw new \ErrorException($mensaje, 0, $severidad, $fichero, $línea);
});

require_once 'vendor/autoload.php';

use Kodoti\Provider\MySql\database as MySql,
    Kodoti\Provider\MSSQL\database as MSSQL; 

$obj = new MySql();
$obj1 = new MSSQL();

var_dump($obj);
var_dump($obj1);

use Kodoti\Helpers\{ivaHelper as Iva, mathHelper as Math, discountHelper as Disc}; 

var_dump(Iva::calculate(100));
var_dump(Math::calculate());
//Control de excepciones
try {
    var_dump(Disc::calculate(1200, 0));
} catch (\Throwable $th) {
    //var_dump($th); -> Se muestran todos los detalles del error, es una buena práctica guardar los
                      //errores en un log
    print sprintf('%s %s(%s) %s', $th->getMessage(), $th->getFile(), $th->getLine(), date('y-m-d h:i:s')); 
    print "\n";
}

//Convertir errores de PHP en excepciones
try {
    $x = $a +1; //El error es que no está definida la variable a, así como está el catch no identifica
    //eso como una excepción, por lo que si queremos que sea una excepción hay que usar una funcion
    //global para eso, definida al comienzo del archivo.
} catch (\Throwable $th) {
    print sprintf('%s %s(%s) %s', $th->getMessage(), $th->getFile(), $th->getLine(), date('y-m-d h:i:s')); 
    print "\n";
} finally {
    //Este bloque se ejecuta haya error o no.
}