<?php

namespace App\Enums;

enum Roles: int
{
    case SUPER_ADMIN = 0;
    case ADMIN = 1;
    case MEMBER = 2;

    public function roleName(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::MEMBER => 'Member'
        };
    }
}
