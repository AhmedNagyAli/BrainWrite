<?php

namespace App\Enums;

enum UserRole: string
{
    case SUPER_USER = 'super_user';
    case ADMIN = 'admin';
    case WRITER = 'writer';
    case EDITOR = 'editor';
    case USER = 'user';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_USER => 'Super User',
            self::ADMIN => 'Administrator',
            self::WRITER => 'Writer',
            self::EDITOR => 'Editor',
            self::USER => 'Regular User',
        };
    }
}
