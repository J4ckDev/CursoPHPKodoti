<?php declare (strict_types = 1);
namespace App\Models;

use App\Models\product;

class OrderDetail
{
    private $id;
    private $product_id;
    private $product;
    private $quantity;
    private $price;
    private $total = 0;
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

    public function getProductId(): int
    {
        return intval($this->product_id);
    }
    public function setProductId(int $var): void
    {
        $this->product_id = $var;
    }

    public function getProduct(): product
    {
        return $this->product;
    }
    public function setProduct(product $var): void
    {
        $this->product = $var;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
    public function setQuantity(int $var): void
    {
        $this->quantity = $var;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice(float $var): void
    {
        $this->price = $var;
    }

    public function getTotal(): float
    {
        return $this->total;
    }
    public function setTotal(float $var): void
    {
        $this->total = $var;
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
