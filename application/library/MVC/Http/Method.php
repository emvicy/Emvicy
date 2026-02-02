<?php
/**
 * Header.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Http;

class Method
{
    public static function GET()
    {
        return 'GET';
    }

    public static function POST()
    {
        return 'POST';
    }

    public static function PUT()
    {
        return 'PUT';
    }

    public static function DELETE()
    {
        return 'DELETE';
    }

    public static function HEAD()
    {
        return 'HEAD';
    }

    public static function OPTIONS()
    {
        return 'OPTIONS';
    }

    public static function PATCH()
    {
        return 'PATCH';
    }

    public static function TRACE()
    {
        return 'TRACE';
    }

    public static function CONFLICT()
    {
        return 'CONFLICT';
    }
}