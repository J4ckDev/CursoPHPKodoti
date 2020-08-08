<?php declare(strict_types = 1);

function getPermissionsByRole(string $role) : Array {
    $permissions = [
        'admin' => [
            'Puede crear usuarios',
            'Puede actualizar usuarios',
            'Puede eliminar usuarios',
            'Puede visualizar usuarios'
        ],
        'moderator' => [
            'Puede actualizar usuarios',
            'Puede visualizar usuarios'
        ]
    ];

    return $permissions[$role] ?? ['Puede visualizar usuarios']; //Si el rol existe y no es nulo retorne $permissions[$role] sino retorne el valor por defecto
}

var_dump(getPermissionsByRole('guest'));