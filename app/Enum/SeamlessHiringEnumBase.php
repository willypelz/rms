<?php


namespace App\Enum;


class SeamlessHiringEnumBase
{
    public static function getConstants() : array
    {
        $oClass = new \ReflectionClass(get_called_class());
        return $oClass->getConstants();
    }

    public static function getCommaSeperatedConstants() : string
    {
        $oClass = new \ReflectionClass(get_called_class());
        $array =  array_values($oClass->getConstants());

        return implode(',', $array);
    }

    public static function getConstantsArray() : array
    {
        $oClass = new \ReflectionClass(get_called_class());
        $array =  array_values($oClass->getConstants());

        return $array;
    }
}
