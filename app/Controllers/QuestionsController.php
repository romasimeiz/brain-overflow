<?php
 
namespace Controllers;

class QuestionsController extends AbstractController 
{
    public function index()
    {
        $questions = \Models\Question::all();
        return ['body' => $this->render('questions/index', compact('questions'))]; 
    }
}