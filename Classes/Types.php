<?php


class Types
{
    public static function GiveTypes($a)
    {
        switch ($a)
        {
            case 1:
                return "custommer";
                break;
            case 2:
                return "Shmgar";
                break;
            case 3:
                return "CAAI";
                break;
            case 4:
                return "Air_Force";
                break;
            default:
                return null;
        }
    }

}