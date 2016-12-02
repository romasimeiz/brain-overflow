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
        Models\Model::$db = new \PDO($connection_string , $user, $password);
    }

    public static function run($request)
    {
        $request_url = $request['server']['REQUEST_URI'];
        $routes = [
            '\/'          => 'QuestionsController@index',
            '\/question\/(\d*)' => 'QuestionsController@view'
        ];

        foreach ($routes as $url => $handler) {
            $matches = [];
            preg_match('/^'.$url. '$/', $request_url, $matches);
            if (!empty($matches)) {
                list($class, $method) = explode('@', $handler);
                $class = 'Controllers\\'.$class;
                $controller = new $class;
                if (!empty($matches) && $matches[0]) {
                    $args =  array_slice($matches, 1);
                    return call_user_func_array(array($controller, $method), array($request, $args));
                }
            }
        }
        return ['body' => 'page not found', 'code' => 404];
    }
}