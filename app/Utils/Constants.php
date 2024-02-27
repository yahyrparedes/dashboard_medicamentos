<?php

namespace App\Utils;


class Constants
{

    // Route
    public const ROUTE_HOME_ADMIN = '/dashboard';

    // Role
    public const ROLE_SUPER_ADMIN = 'SUPER_ADMIN';
    public const ROLE_ADMIN = 'ADMIN';
    public const ROLE_DOCTOR = 'DOCTOR';
    public const ROLE_PATIENT = 'PACIENTE';
    public const _COOKIE_KEY_ = 'z5vHyTWe26LVWWIOCBH4sZ64sT9dxmwNeGPMofU0qLMFxT6HVKdqbU3y';

    public static function transformCode(string $code): string
    {
        $data = str_split($code, 3);
        return $data[0] . '-' . $data[1] . $data[2];
    }

    public static function validateISApi(array $url): bool
    {
        return $url[0] == 'api';
    }

}
