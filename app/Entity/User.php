<?php
namespace Entity;

use Models\Model;

class User extends Model
{
    public static $table = 'users';

    public function questions()
    {
        return $this->hasMany('Question', 'user_id');
    }

    public function answers($value='')
    {
        return $this->hasMany('Answer', 'user_id');
    }
}