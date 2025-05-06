<?php
include_once "models/Student.class.php";
include_once "view/Student.view.php";

class StudentController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new Student();
        $this->view = new StudentView();
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
        $result = $this->model->getStudent();
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
        $this->model->addStudent($_POST);
        header("Location: index.php?page=students&action=index");
    }

    private function edit() {
        $id = $_GET['id'];
        $result = $this->model->getStudentById($id);
        $student = $result->fetch_assoc();
        $this->view->renderUpdate($student);
    }

    private function update() {
        $data = $_POST;
        $data['id'] = $_GET['id'];
        $this->model->updateStudent($data);
        header("Location: index.php?page=students&action=index");
    }

    private function delete() {
        $id = $_GET['id'];
        $this->model->deleteStudent($id);
        header("Location: index.php?page=students&action=index");
    }
}
?>
