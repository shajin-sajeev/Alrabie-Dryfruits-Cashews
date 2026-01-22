<?php

namespace App;

class Str
{
    public static function slug($title)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
    }

    public static function limit($string, $limit = 100)
    {
        if (strlen($string) <= $limit) {
            return $string;
        }
        return substr($string, 0, $limit) . '...';
    }
}
