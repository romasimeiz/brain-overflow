<?php
namespace Models;

class QueryBuilder
{
    public function __construct($resultClass, $table, $db)
    {
        $this->db = $db;
        $this->resultClass = $resultClass;
        $this->query = "SELECT * FROM ".$table;
    }

    public function where($condition)
    {
        $this->query .= " WHERE $condition";
        return $this;
    }

    public function limit($num)
    {
        $this->query .= " LIMIT $num";
        return $this;
    }

    public function get()
    {
        $statement = $this->db->prepare($this->query);
        $statement->execute();
        echo "\n".$this->query."\n";
        return $statement->fetchAll(\PDO::FETCH_CLASS, $this->resultClass);
    }

    public function getOne()
    {
        return $this->get()[0];
    }
}