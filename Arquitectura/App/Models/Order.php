<?php declare (strict_types = 1);
namespace App\Models;

use App\Models\User;

class Order
{
    private $id;
    private $user_id;
    private $total = 0;
    private $creater_id;
    private $created_at;
    private $updated_at;
    private $detail = []; //Array de OrderDetail
    private $client;
    private $creater;

    public function getId(): int
    {
        return intval($this->id);
    }
    public function setId(int $var): void
    {
        $this->id = $var;
    }

    public function getUserId(): int
    {
        return intval($this->user_id);
    }
    public function setUserId(int $var): void
    {
        $this->user_id = $var;
    }

    public function getTotal(): float
    {
        return $this->total;
    }
    public function setTotal(float $var): void
    {
        $this->total += $var;
    }

    public function getCreaterId(): int
    {
        return intval($this->creater_id);
    }
    public function setCreaterId(int $var): void
    {
        $this->creater_id = $var;
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

    public function getDetail(): array
    {
        return $this->detail;
    }
    public function setDetail(array $var): void
    {
        $this->detail = $var;
    }

    public function getClient(): User
    {
        return $this->client;
    }
    public function setClient(User $var): void
    {
        $this->client = $var;
    }

    public function getCreater(): User
    {
        return $this->creater;
    }
    public function setCreater(User $var): void
    {
        $this->creater = $var;
    }
}
