<?php
class MainController {

    private $controller;

    private $view;

    private $model;

    public function __construct($target, $action) {

        if($target === 'home') {
            require_once('model/ModelHome.php');
            require_once('view/ViewHome.php');
            require_once('controller/ControllerHome.php');

            $model = new ModelHome();
            $controller = new ControllerHome($model, $action);
            $view = new ViewHome($model);
            echo $view->display();

        }
        if($target === 'login') {
            require_once('model/ModelLogin.php');
            require_once('view/ViewLogin.php');
            require_once('controller/ControllerLogin.php');

            $model = new ModelLogin();
            $controller = new ControllerLogin($model, $action);
            $view = new ViewLogin($model);
            // echo $target.$action.'...'.'...';
            echo $view->display();
        }
        if($target === 'discussion') {
            require_once('model/ModelDiscussion.php');
            require_once('view/ViewDiscussion.php');
            require_once('controller/ControllerDiscussion.php');

            $model = new ModelDiscussion();
            $controller = new ControllerDiscussion($model, $action);
            $view = new ViewDiscussion($model);
            // echo $target.$action.'...'.'...';
            echo $view->display();
        }

    }

}
?>