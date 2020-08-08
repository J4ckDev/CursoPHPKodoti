<?php declare (strict_types = 1);
namespace App\Models;

class User
{
    private $id;
    private $first_name;
    private $last_name;
    private $user_name;
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

    public function getFName(): string
    {
        return $this->first_name;
    }
    public function setFName(string $var): void
    {
        $this->first_name = $var;
    }

    public function getLName(): string
    {
        return $this->last_name;
    }
    public function setLName(string $var): void
    {
        $this->last_name = $var;
    }

    public function getUName(): string
    {
        return $this->user_name;
    }
    public function setUname(string $var): void
    {
        $this->user_name = $var;
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
