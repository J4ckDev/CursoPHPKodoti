<?php declare (strict_types = 1);
namespace App\Repositories;

use App\Models\User;
use Kodoti\Database\dbProvider;

class UserRepository
{
    private $_db;

    public function __construct()
    {
        $this->_db = dbProvider::get();
    }

    public function find(int $id): ?User
    {
        $result = null;

        $query = 'select * from users where id = :id';
        $stm = $this->_db->prepare($query);

        $stm->execute(['id' => $id]);

        $result = $stm->fetchObject('\\App\\Models\\User');
        unset($result->password);

        return $result;
    }
}
