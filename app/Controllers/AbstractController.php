<?php 
namespace Controllers;

class AbstractController  {
    // public function render($path, $data)
    // {
    //     $full_path = \App::$BASE_DIR.'/templates/'.$path.'.php';

    //     ob_start();
    //         extract($data);
    //         require_once $full_path;
    //     return ob_get_clean();
    // }

    public function render($path, $data)
    {
        $loader = new \Twig_Loader_Filesystem(\App::$BASE_DIR.'/templates');

        $twig = new \Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new \Twig_Extension_Debug());

        return $twig->render($path.'.html', $data);
    }
}