<?php

class App
{
    public static $BASE_DIR;

    public static function bootstrap()
    {
        self::$BASE_DIR = __DIR__.'/..';
        $connection_string = "mysql:host=localhost;dbname=brainoverflow";
        $user = 'admin';
        $password = '123';
        Models\Model::$db = new \PDO($connection_string, $user, $password);
        dd(\Entity\Answer::first()->user());
    }

    public static function run($request)
    {
        $request_url = $request['server']['REQUEST_URI'];
        $routes = [
            '/' => 'QuestionsController@index'
        ];

        foreach ($routes as $url => $handler) {
            if ($request_url == $url) {
                list($class, $method) = explode('@', $handler);
                $class = 'Controllers\\'.$class;
                $controller = new $class;

                return $controller->$method($request);
            }
        }
        return ['body' => 'page not found', 'code' => 404];
    }
}