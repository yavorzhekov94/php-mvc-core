<?php

namespace yzh\phhpmvc\db;

use yzh\phhpmvc\Model;
use yzh\phhpmvc\Application;

/**
 * Class DbModel
 * 
 * @author Yavor Zhekov
 * @package yzh\phhpmvc
 */
abstract class DbModel extends Model
{
    
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attrbutes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attrbutes);
        $sql = "INSERT INTO $tableName (".implode(',', $attrbutes).") VALUES(".implode(',', $params).")";
        $statement = self::prepare($sql);

        foreach ($attrbutes as $attribute)
        {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        // echo "<pre>";
        //     var_dump($this);
        //     echo "</pre>";

        $statement->execute();
        return true;

        
    }

    public static function findOne($where)
    {
        $tableName = 'users';
        $attrbutes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attrbutes));
        // SELECT * FROM $tableName WHERE email = :email AND firstname = :firstname
        $statement =  self::prepare("SELECT * FROM $tableName WHERE $sql"); 
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}
