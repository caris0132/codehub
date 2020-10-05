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

    public function insert($tableName, $insertData)
    {

        return $this->_buildInsert($tableName, $insertData, 'INSERT');
    }

    private function _buildInsert($tableName, $insertData, $operation)
    {
        if ($this->isSubQuery) {
            return;
        }

        $this->_query = $operation . " " . implode(' ', $this->_queryOptions) . " INTO " . self::$prefix . $tableName;
        $stmt = $this->_buildQuery(null, $insertData);
        $status = $stmt->execute();
        $this->_stmtError = $stmt->error;
        $this->_stmtErrno = $stmt->errno;
        $haveOnDuplicate = !empty ($this->_updateColumns);
        $this->reset();
        $this->count = $stmt->affected_rows;

        if ($stmt->affected_rows < 1) {
            // in case of onDuplicate() usage, if no rows were inserted
            if ($status && $haveOnDuplicate) {
                return true;
            }
            return false;
        }

        if ($stmt->insert_id > 0) {
            return $stmt->insert_id;
        }

        return true;
    }
}
