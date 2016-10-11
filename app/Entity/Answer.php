<?php
namespace Entity;

use Models\Model;

class Answer extends Model
{
    public static $table = 'answers';

    public function question()
    {
        return $this->belongsTo('Entity\Question', 'question_id');
    }

    public function user()
    {
        return $this->belongsTo('Entity\User', 'user_id');
    }
}