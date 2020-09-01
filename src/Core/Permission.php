<?php

namespace App\Core;

class Permission
{
    const ROLE_SEEN_LIST = 1; // 2^0
    const ROLE_ADD = 2; // 2^1
    const ROLE_EDIT = 4; // 2^...
    const ROLE_DELETE = 8; // 2^3

    public static function checkRole($value, $role_value = self::ROLE_SEEN_LIST)
    {
        return $value & $role_value;
    }

    public static function getRoleByAction($action)
    {
        $result = 0;
        if(empty($action)) {
            return $result;
        }

        switch ($action) {
            case 'man':
                $result = self::ROLE_SEEN_LIST;
                break;

            case 'add':
            case 'save':
                $result = self::ROLE_ADD;
                break;

            case 'edit':
            case 'save':
                $result = self::ROLE_EDIT;
                break;

            case 'delete':
                $result = self::ROLE_DELETE;
                break;
        }

        return $result;
    }
}
