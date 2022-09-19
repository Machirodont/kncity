<?php

namespace kncity\app;

class Auth
{
    private const AUTH_TOKEN_LENGTH = 32;

    public static function generateAuthToken(): string
    {
        return bin2hex(random_bytes(self::AUTH_TOKEN_LENGTH));
    }
}