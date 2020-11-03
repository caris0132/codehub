<?php

namespace App\Core;

use App\Core\Database;

class Seo
{
    private $d;
    private $data;

    function __construct($d)
    {
        $this->d = $d;
    }

    public static function getSEOByComID($com, $id)
    {
        if (empty($com) || empty($id)) {
            throw new \Exception("component and id not empty");
        }
        $d = Database::getInstance();
        $d->where('com', $com);
        $d->where('own_id', $id);
        return $result = $d->arrayChangeKeyValue($d->get('seo'), 'lang');
    }

    public static function saveSEOByComID($com, $id, $lang, $data)
    {
        if (empty($com) || empty($id) || empty($lang)) {
            throw new \Exception("Some thing went wrong!");
        }

        $d = Database::getInstance();
        $d->where('com', $com);
        $d->where('own_id', $id);
        $d->where('lang', $lang);

        if ($row = $d->getOne('seo', 'id')) {
            $d->where('id', $row['id']);
            return $d->update('seo', $data);
        } else {

            return $d->insert('seo', $data);
        }

        return false;

    }

    public static function deleteSEOByComID($com, $id)
    {
        if (empty($com) || empty($id)) {
            throw new \Exception("Some thing went wrong!");
        }

        $d = Database::getInstance();
        $d->where('com', $com);
        $d->where('own_id', $id);
        return !!$d->delete('seo'); // !!$d->delete('seo') convert về boolean

    }

    public function setSeo($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function getSeo($key)
    {
        return $this->data[$key];
    }

    public function getSeoDB($id = 0, $com = '', $act = '', $type = '')
    {
        if ($id || $act == 'capnhat') {
            if ($id) $row = $this->d->rawQueryOne("select * from table_seo where idmuc = ? and com = ? and act = ? and type = ?", array($id, $com, $act, $type));
            else $row = $this->d->rawQueryOne("select * from table_seo where com = ? and act = ? and type = ?", array($com, $act, $type));

            return $row;
        }
    }

    public function updateSeoDB($json = '', $table = '', $id = 0)
    {
        if ($table && $id) $this->d->rawQuery("update #_$table set options = ? where id = ?", array($json, $id));
    }
}
