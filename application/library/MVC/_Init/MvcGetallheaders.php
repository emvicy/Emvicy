<?php

namespace MVC\_Init;

class MvcGetallheaders
{
    public static function do()
    {
        $aHeader = [];

        foreach ($_SERVER as $name => $value)
        {
            if (substr($name, 0, 5) == 'HTTP_')
            {
                $aHeader[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }

        return $aHeader;
    }
}
