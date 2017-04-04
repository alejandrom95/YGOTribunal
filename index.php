<?php
    require_once('controller/main_controller.php');
    session_start();
    $target = '';
    $action = '';
    
    if (isset($_GET['target'])) {
        $target = $_GET['target'];
    }
    else {
        $target = 'home';
        $action = 'display';
    }
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }
    else {
        $target = 'home';
        $action = 'display';
    }
    if(isset($_SESSION['login_status'])) {
        if($_SESSION['login_status'] <> 'LOGGED_IN') {
            if(!($target === 'login' && ($action === 'signup' || $action === 'login'))) {
                $target = 'login';
                $action = 'display';
            }
        }
    }
    else {
        if(!($target === 'login' && ($action === 'signup' || $action === 'login'))) {
            $target = 'login';
            $action = 'display';
        }
        
    }
    
    $main_controller = new MainController($target, $action);
?>
