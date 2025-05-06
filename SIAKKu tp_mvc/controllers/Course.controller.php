<?php
include_once "models/Course.class.php";
include_once "view/Course.view.php";

class CourseController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new Course();
        $this->view = new CourseView();
    }

    public function handleRequest($action) {
        switch ($action) {
            case 'index':
                $this->index();
                break;
            case 'create':
                $this->create();
                break;
            case 'store':
                $this->store();
                break;
            case 'edit':
                $this->edit();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                $this->index();
                break;
        }
    }

    private function index() {
        $result = $this->model->getCourse();
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        $this->view->renderIndex($students);
    }

    private function create() {
        $this->view->renderCreate();
    }

    private function store() {
        $this->model->addCourse($_POST);
        header("Location: index.php?page=course&action=index");
    }

    private function edit() {
        $id = $_GET['id'];
        $result = $this->model->getCourseById($id);
        $student = $result->fetch_assoc();
        $this->view->renderUpdate($student);
    }

    private function update() {
        $data = $_POST;
        $data['id'] = $_GET['id'];
        $this->model->updateCourse($data);
        header("Location: index.php?page=course&action=index");
    }

    private function delete() {
        $id = $_GET['id'];
        $this->model->deleteCourse($id);
        header("Location: index.php?page=course&action=index");
    }
}
?>
