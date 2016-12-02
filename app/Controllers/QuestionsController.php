<?php
 
namespace Controllers;

class QuestionsController extends AbstractController 
{
    public function index($request)
    {
        dd('index');
        $questions = \Entity\Question::all();
        return ['body' => $this->render('questions/index', compact('questions'))]; 
    }

    public function view($request, $args)
    {
        $id = $args[0];
        $question = \Entity\Question::find($id);
        if(isset($request['request']['answer-text'])) {
            if ($request['request']['answer-text']) {
                echo "ok";
            }
        }
        /*
        $page = $_GET['page'];
        $PER_PAGE = 10;
        $pagination = new Pagination($page, $totalCount, $PER_PAGE);

        $pagination->pageCount = 5;
        $pagination->hasPrev;
        $pagination->hasNext;
        $pagination->pages = [1,2,3,null,99,100];
        */
        return ['body' => $this->render('questions/question', compact('question'))];
    }
}