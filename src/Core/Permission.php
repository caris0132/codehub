<?php

namespace App\Core;

class Permission
{
    const ROLE_SEEN_LIST = 1; // 2^0
    const ROLE_ADD = 2; // 2^1
    const ROLE_EDIT = 4; // 2^...
    const ROLE_DELETE = 8; // 2^3

    const ACTION_SEEN_LIST = [
        'man',
        'man_list',
        'man_cat',
        'man_sub',
        'man_item',
        'man_photo',
        'man_city',
        'man_district',
        'man_wards',
        'man_street',
    ];

    const ACTION_ADD = [
        'add',
        'add_list',
        'add_cat',
        'add_item',
        'add_sub',
        'add_brand',
        'add_mau',
        'add_size',
        'add_photo',
        'add_city',
        'add_district',
        'add_wards',
        'add_street',
    ];

    const ACTION_EDIT = [
        'edit',
        'edit_list',
        'edit_cat',
        'edit_item',
        'edit_sub',
        'edit_brand',
        'edit_mau',
        'edit_size',
        'photo_static',
        'edit_photo',
        'edit_city',
        'edit_district',
        'edit_wards',
        'edit_street',
    ];

    const ACTION_SAVE = [
        'save',
        'save_copy',
        'save_list',
        'save_cat',
        'save_item',
        'save_sub',
        'save_brand',
        'save_mau',
        'save_size',
        'saveImages',
        'uploadExcel',
        'save_static',
        'save_photo',
        'save_city',
        'save_district',
        'save_wards',
        'save_street',
        'capnhat',
        'save_photo',
    ];
    const ACTION_DELETE = [
        'delete',
        'delete_list',
        'delete_cat',
        'delete_item',
        'delete_sub',
        'delete_brand',
        'delete_city',
        'delete_district',
        'delete_wards',
        'delete_street',
        'delete_photo',
        'delete_city',
        'delete_district',
        'delete_wards',
        'delete_street',
    ];

    public function checkRole($value, $role_value = self::ROLE_SEEN_LIST)
    {
        return $value & $role_value;
    }

    public function getRoleByAction($action)
    {
        if(empty($action)) {
            return false;
        }

        if(in_array($action, self::ACTION_SEEN_LIST)) {
            return self::ROLE_SEEN_LIST;
        }

        if(in_array($action, self::ACTION_ADD)) {
            return self::ROLE_ADD;
        }

        if(in_array($action, self::ACTION_DELETE)) {
            return self::ROLE_DELETE;
        }

        return false;
    }
}
