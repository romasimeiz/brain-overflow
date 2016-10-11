<?php
namespace Entity;

use Models\Model;

class Question extends Model
{
    public static $table = 'questions';

    public function answers()
    {
        return $this->hasMany('Entity\Answer', 'question_id');
    }

    public function user()
    {
        return $this->belongsTo('Entity\User', 'user_id');
    }
}