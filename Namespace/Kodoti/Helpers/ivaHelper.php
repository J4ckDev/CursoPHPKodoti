<?php
namespace Kodoti\Helpers;

class ivaHelper{
    public static function calculate(float $price) : float {
        return $price * 0.18;
    }
}