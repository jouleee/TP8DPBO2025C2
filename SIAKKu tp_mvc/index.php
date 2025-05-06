<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

if ($page == 'students') {
    include_once("controllers/Student.controller.php");
    $controller = new StudentController();
    $controller->handleRequest($action);
} else if ($page == 'course') {
    include_once("controllers/Course.controller.php");
    $controller = new CourseController();
    $controller->handleRequest($action);
} else if ($page == 'enrollment') {
    include_once "controllers/Enrollment.conroller.php";
    $controller = new EnrollmentController();
    $controller->handleRequest($action);
} else if ($page == 'home') {
    include_once("view/home.view.php");
    $view = new HomeView();
    $view->renderHome();
}
?>
