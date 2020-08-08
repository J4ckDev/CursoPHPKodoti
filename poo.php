<?php declare(strict_types = 1);

class mobileDevice{

    /*Atributos*/
    private $brand;
    private $model;
    private $color;

    /*Métodos*/
     /*El constructor es el método que se ejecuta al instanciar una clase*/
    public function __construct(string $brand, string $model, string $color){
        $this->brand = $brand;
        $this->model = $model;
        $this->color = $color;
    }
    //Get set Brand
    public function getBrand() : string{
        return $this->brand;
    }
    public function setBrand(string $brand) : void
    {
        $this->brand = $brand;
    }

    public function turnOn() : string
    {
        return "$this->brand ha sido encendido";
    }

    public function makeACall(string $phoneNumber) : string
    {
        return "$this->brand está llamando al número: $phoneNumber";
    }
}

$obj = new mobileDevice('Iphone','X','White');

print $obj->turnOn();
print $obj->makeACall('9999999999');
$obj->setBrand('Huawei');
print $obj->getBrand();

//Métodos estáticos y constantes

class priceHelper{
    const DISCOUNT = 0.2;
    public static function getDiscount(float $precio) : float{
        return $precio * self::DISCOUNT;
    }
}

echo priceHelper::getDiscount(200);

//Herencia

//class producto
abstract class producto
{
    public $name;
    public $price;

    protected function calculateDiscount(float $discount) : float{ //Disponible solo en las clases que hereden
        return $this->price * $discount;
    }
    public function helloWorld() : string{
        return "Hola mundo, esto es $this->name";
    }
}

class book extends producto{
    public $releaseDate;

    public function __construct(string $name, float $price, string $releaseDate)
    {
        $this->name = $name;
        $this->price = $price;
        $this->releaseDate = $releaseDate;
    }
    public function getDiscount(){
        return $this->calculateDiscount(0.2);
    }
}

class guitar extends producto{
    public $releaseDate;

    public function __construct(string $name, float $price, string $type)
    {
        $this->name = $name;
        $this->price = $price;
        $this->releaseDate = $type;
    }
    public function getDiscount(){
        return $this->calculateDiscount(0.2);
    }
}

$obj = new book('Resident Evil 2', 7.99, '2008-02-11'); 
$obj1 = new book('Fender', 1700, 'Eléctrica');

var_dump($obj->getDiscount()); //El metodo calculateDiscount no puede ser llamado directamente desde el objeto.

//Clase abstracta -> No puede ser instanciada pero si implementa sus propios atributos y métodos.
//Solo funciona a través de la herencia y puede ser implementada mediante las clases hijas.

class pc{

}
$obj2 = new pc();

function getObjectName(producto $obj): string{
    /*
        Un ejemplo donde se puede aplicar la lógica de colocar como tipo de entrada a la clase 
        abstracta, es si se tienen múltiples productos (clases hijas) pero solo se desea guardar 
        en una base de datos el nombre y el precio (siguiendo el contexto del ejercicio), no es
        necesario crear una clase libro, guitar, etc, sino que simplemente usando la clase de 
        donde heredan, se obtienen solo los datos de interés ahorrando mucho código y memoria.
    */ 
    return $obj->name;
}

var_dump(getObjectName($obj));

/*Interfaces 
    Son los nombres de los métodos a usar pero no la implementacion. Las clases hijas que
    hagan uso de la interfaz deberan si o si usar todos los métodos definidos en la interfaz.
    Los patrones de diseño son muy usados con la declaración de interfaces, un ejemplo es el patrón
    de inyección de dependencia se suele trabajar mucho con las interfaces, porque no interesa la
    implementación, solo me interesa la especificación.
    Ejemplo con un patron de diseño factory, aunque es pseudofactory en realidad.
*/

interface iMailer{
    public function send();
}

class mailchimp implements iMailer {
    public function send() : string{
        return 'Enviando un correo usando Mailchimp';
    }
}

class sendGrid implements iMailer {
    public function send() : string{
        return 'Enviando un correo usando SendGrid';
    }
}

class mailerFactory{
    private static $mailer;

    public static function set(iMailer $mailer) : void {
        if (!self::$mailer) { //Si $mailer está vacío
            self::$mailer = $mailer;
        }
    }

    public static function send() : string
    {
        return self::$mailer->send();
    }
}

mailerFactory::set(new mailchimp);
mailerFactory::set(new sendGrid);
print mailerFactory::send();