<?php
namespace Models;
class Model
{
    public static $db;
    public static $table='';

    public static function all()
    {
        return static::query()->get();
    }

    public static function first()
    {
        return static::query()->limit(1)->getOne();
    }

    public static function query()
    {
        return new QueryBuilder(static::class, static::$table, static::$db);
    }

    public static function update($params)
    {
        $query = "UPDATE " . static::$table;
    }

    public static function find($id)
    {
        return static::query()->where(" id = '$id'")->getOne();
    }

    public function hasMany($childClass, $childForeignKey)
    {
        return $childClass::query()->where("$childForeignKey = '{$this->id}'");
    }

    public function belongsTo($parentClass, $childForeignKey)
    {
        return $parentClass::query()->where("id = '{$this->$childForeignKey}'")
                              ->getOne();
    }

    public static function create($params)
    {
        $className = static::class;
        $object = new $className;
        foreach ($params as $key => $value) {
            $object->$key = $value;
        }
        return $object;
        /* Answer::create(['body'=>'olol'])*/

        /* create new object of current class */
        /* set all params*/
        /* $object->save */
        /* return this object */
    }

    public function save()
    {

        $params = (array)$this;

        if ($this->id) {
            $this->update($params);
            /* $UPDATE static::$table (col1, col2) SET (v1,v2) where id=$this->id; */
        } else {

            /* $id = INSERT INTO static::$table (col1, col2) VALUES (v1,v2); */
            /* $this->id = $id; */
        }
    }
}