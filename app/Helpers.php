<?php

namespace App;

use Mews\Purifier\Facades\Purifier;

class Helpers
{
    /**
     * @var string
     */
    public static function trailingSlashIt(string $string): string
    {
        if ($string != config('app.url')) {
            return self::untrailingSlashIt($string) . '/';
        }

        return $string;
    }

    public static function untrailingSlashIt(string $string): string
    {
        return rtrim($string, '/\\');
    }

    /**
     * Generate password
     */
    public static function generatePassword()
    {
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*_-+=";
        return substr(str_shuffle($characters), 0, 12);
    }
}
