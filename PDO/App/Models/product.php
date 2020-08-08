<?php declare (strict_types = 1);
namespace App\Models;

class product
{
    private $id;
    private $name;
    private $price;
    private $created_at;
    private $updated_at;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $var): void
    {
        $this->id = $var;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $var): void
    {
        $this->name = $var;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice(float $var): void
    {
        $this->price = $var;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
    public function setCreatedAt(string $var): void
    {
        $this->created_at = $var;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
    public function setUpdatedAt(string $var): void
    {
        $this->updated_at = $var;
    }
}
