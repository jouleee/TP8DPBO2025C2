<?php
include_once("connection.php");
include_once("models/Student.class.php");
include_once("models/Course.class.php");

class HomeController
{
    private $student;
    private $course;

    public function __construct()
    {
        $this->student = new Student(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->course = new Course(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index()
    {
        $students = $this->studentModel->getStudent();
        $courses = $this->courseModel->getCourse();
        include_once("views/index.php");
    }
}
?>