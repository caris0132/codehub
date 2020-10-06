<?php

namespace App\Core;

use MysqliDb;

class Database extends MysqliDb
{
    public function rawQuery($query, $params = null)
    {
        $query = str_replace('#_', self::$prefix, $query);
        return parent::rawQuery($query, $params);
    }
    public function rawQueryOne($query, $params = null)
    {
        $query = str_replace('#_', self::$prefix, $query);
        return parent::rawQueryOne($query, $params);
    }
    public function getLastInsertId()
    {
        return $this->_lastInsertId;
    }

    public function insert($tableName, $insertData)
    {
        $insertData = $this->prepareDataBeforeQuery($tableName, $insertData);
        return parent::insert($tableName, $insertData);
    }

    public function prepareDataBeforeQuery($tableName, $data)
    {
        $values = "";
        $pri = '';
        $sql = "SHOW COLUMNS FROM " . self::$prefix . $tableName;
        $columnSchema = $this->rawQuery($sql);

        $info_column = $this->arrayChangeKeyValue($columnSchema, 'Field');

        foreach ($data as $key => $value) {
            if (strtolower($info_column[$key]['Key']) == "pri") {
                unset($data[$key]);
            } elseif (strpos($info_column[$key]['Type'], 'int') !== false | strpos($info_column[$key]['Type'], 'float') !== false | strpos($info_column[$key]['Type'], 'double') !== false) {
                if ($data[$key] == false || !is_numeric($data[$key])) {
                    $data[$key] = 0;
                }
                $data[$key] = floatval($data[$key]);

            }
        }
        return $data;

    }

    public function arrayChangeKeyValue($data, $groupByKey)
    {
        $groupArray = array();
        foreach ($data as $singleData) {
            $groupArray[$singleData[$groupByKey]] = $singleData;
        }
        return $groupArray;
    }
}
