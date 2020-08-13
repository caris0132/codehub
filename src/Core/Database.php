<?php
namespace App\Core;

use MysqliDb;
class Database extends MysqliDb
{
    public function rawQuery($query, $params = null)
    {
        $query = str_replace('#_', parent::$prefix, $query);
        return parent::rawQuery($query, $params);
    }
    public function getLastInsertId()
    {
        return $this->_lastInsertId;
    }
}
