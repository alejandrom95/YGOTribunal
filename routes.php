<?php
class Router {

    private $table = array();

    

    public function __construct() {

        //"exampleroute" is the name of the route, e.g. /exampleroute

        //Here, class names are used rather than instances so instances are only ever created when needed, otherwise every model, view and 

        //controller in the system would be instantiated on every request, which obviously isn't good!

        $this->table['exampleroute'] = new Route('Model', 'View', 'Controller');  

        $this->table['someotherroute'] = new Route('OtherModel', 'OtherView', 'OtherController');  

    }

    

    public function getRoute($route) {

        $route = strtolower($route);

        return $this->table[$route];        

    }

}



class Route {

    public $model;

    public $view;

    public $controller;

    

    public function __construct($model, $view, $controller) {

        $this->model = $model;

        $this->view = $view;

        $this->controller = $controller;        

    }

}
?>