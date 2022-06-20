<?php
namespace application\libs;

class Application{
    
    public $controller;
    public $action;

    public function __construct() { //생성자 함수
        $getUrl = '';
        if (isset($_GET['url'])) {
            $getUrl = rtrim($_GET['url'], '/');
            $getUrl = filter_var($getUrl, FILTER_SANITIZE_URL);
        }        
        $getParams = explode('/', $getUrl);
        $controller = isset($getParams[0]) && $getParams[0] != '' ? $getParams[0] : 'board';
        $action = isset($getParams[1]) && $getParams[1] != '' ? $getParams[1] : 'index';

        if (!file_exists('application/controllers/'. $controller .'Controller.php')) {
            echo "해당 컨트롤러가 존재하지 않습니다.";
            exit();
        }
        $controllerName = 'application\controllers\\' . $controller . 'controller';        
        new $controllerName($action);   //action <- 생성자 함수 호출
    }
}