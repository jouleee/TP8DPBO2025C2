<?php
include_once "models/Enrollment.class.php";
include_once "models/Student.class.php";
include_once "models/Course.class.php";
include_once "view/Enrollment.view.php";

class EnrollmentController {
    private $model;
    private $studentModel;
    private $courseModel;
    private $view;

    public function __construct() {
        $this->model = new Enrollment();
        $this->studentModel = new Student();
        $this->courseModel = new Course();
        $this->view = new EnrollmentView();
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
            case 'changeStatus':
                $this->changeStatus();
                break;
            default:
                $this->index();
                break;
        }
    }

    private function index() {
        $data = $this->model->getEnrollment();
        $this->view->renderIndex($data);
    }

    private function create() {
        $students = $this->studentModel->getStudent();
        $courses = $this->courseModel->getCourse();
        $this->view->renderCreate($students, $courses);
    }

    private function store() {
        $data = [
            'id_student' => $_POST['id_student'],
            'id_course' => $_POST['id_course'],
            'semester' => $_POST['semester'],
            'date_enrollment' => $_POST['date_enrollment'] ?: date('Y-m-d'),
            'status' => 1
        ];

        if ($this->model->isEnrolled($data['id_student'], $data['id_course'], $data['semester'])) {
            $_SESSION['error'] = "Mahasiswa sudah terdaftar di semester yang sama untuk mata kuliah ini.";
            header("Location: index.php?page=enrollment&action=create");
            exit();
        }

        $result = $this->model->addEnrollment($data);

        $_SESSION[$result ? 'message' : 'error'] = $result
            ? "Pendaftaran berhasil"
            : "Pendaftaran gagal";

        header("Location: index.php?page=enrollment&action=index");
        exit();
    }

    private function edit() {
        $id = $_GET['id'];
        $enrollment = $this->model->getEnrollmentById($id);
        if (!$enrollment) {
            $_SESSION['error'] = "Data tidak ditemukan";
            header("Location: index.php?page=enrollment&action=index");
            exit();
        }
        $students = $this->studentModel->getStudent();
        $courses = $this->courseModel->getCourse();
        $this->view->renderUpdate($enrollment, $students, $courses);
    }

    private function update() {
        $id = $_GET['id'];
        $data = [
            'id_students' => $_POST['id_student'],
            'id_course' => $_POST['id_course'],
            'semester' => $_POST['semester'],
            'date_enrollment' => $_POST['date_enrollment'],
            'status' => $_POST['status']
        ];

        $current = $this->model->getEnrollmentById($id);
        if ($current['id_students'] != $data['id_students'] ||
            $current['id_course'] != $data['id_course'] ||
            $current['semester'] != $data['semester']) {
            if ($this->model->isEnrolled($data['id_students'], $data['id_course'], $data['semester'])) {
                $_SESSION['error'] = "Mahasiswa sudah terdaftar di semester dan mata kuliah tersebut";
                header("Location: index.php?page=enrollment&action=edit&id=$id");
                exit();
            }
        }

        $result = $this->model->updateEnrollment($id, $data);
        $_SESSION[$result ? 'message' : 'error'] = $result
            ? "Berhasil update pendaftaran"
            : "Gagal update pendaftaran";

        header("Location: index.php?page=enrollment&action=index");
        exit();
    }

    private function delete() {
        $id = $_GET['id'];
        $result = $this->model->deleteEnrollment($id);
        $_SESSION[$result ? 'message' : 'error'] = $result
            ? "Data berhasil dihapus"
            : "Gagal menghapus data";

        header("Location: index.php?page=enrollment&action=index");
        exit();
    }

    private function changeStatus() {
        $id = $_GET['id'];
        $result = $this->model->changeStatus($id);

        $_SESSION[$result ? 'message' : 'error'] = $result
            ? "Status berhasil diubah"
            : "Gagal mengubah status";

        header("Location: index.php?page=enrollment&action=index");
        exit();
    }
}
