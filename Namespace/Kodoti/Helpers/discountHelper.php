<?php declare (strict_types = 1);

namespace Kodoti\Helpers;

use Exception;
//Uso de las excepciones

class discountHelper
{
    public static function calculate(float $amount, float $discount): float
    {
        if ($discount <= 0) {
            throw new Exception('Descuento no válido'); //Declaración de la excepción
        }
        return $amount * $discount;
    }
}
