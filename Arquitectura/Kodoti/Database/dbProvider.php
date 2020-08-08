<?php
namespace Kodoti\Database;

use Pdo;

class dbProvider
{
    private static $_db; /*Se declara de esta manera para que luego de ser instanciado PDO, no se
    pueda volver a instanciar. Se asegura una única instancia*/
    public static function get()
    {
        if (!self::$_db) { //Mientras esté vacío ejecuta.
            $pdo = new Pdo(
                __CONFIG__['db']['host'],
                __CONFIG__['db']['user'],
                __CONFIG__['db']['pass']
            );
    
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); /*Habilitar el muestreo de
            los errores de SQL*/
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); /*Habilitar que por defecto
            la información que retorne de la base de datos, sea un objeto*/

            self::$_db = $pdo;
        }    
        
        return self::$_db;
    }
}
