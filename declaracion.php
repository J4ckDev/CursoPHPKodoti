<?php declare(strict_types=1); //Esta declaraciòn obliga que todo sea estrictamente tipado.

/*Declaraciones en los tipos de entrada*/

function saySomething(string $string) : string{ // Después de : se define el tipo de variable de retorno
    //echo $string; -> Mala práctica
    return 'Hola'.$string;
}

function howOAY(int $year) : int{ //Es una buena práctiva definir tipar las variables de entrada y salida
    return (int) date('Y')-$year;
}

echo saySomething(' JackDev');
echo howOAY(1996);

//Declaración de tipo de retorno

function discount(float $price, float &$discount) : void { //Al anteponer & hace que la variable se pase por referencia y no por valor
    $discount = $price * 0.2;
}

$price = 1000;
$discount = 0;

discount($price,$discount);

print sprintf('Precio inicial: %s', $price); //sprintf devuelve un string con formato.
print "\n";
print sprintf('Descuento: %s', $discount);
print "\n";
print sprintf('Precio Final: %s', $price - $discount);