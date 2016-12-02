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
        if(php_sapi_name() === 'cli') {
            echo $this->query;
        } else {
            $date = new \DateTime();
            $date = $date->format("d-m-Y H:m");
            file_put_contents('../log/queries.txt',  $date . "     "  . $this->query . "\n\n", FILE_APPEND);
        }

        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, $this->resultClass);
    }

    public function getOne()
    {
        return $this->get()[0];
    }
}