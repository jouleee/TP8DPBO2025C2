<?php
include_once "models/DB.class.php";
class Enrollment extends DB
{
    public function getEnrollment() {
        $query = "SELECT 
                    e.*, 
                    s.nim, 
                    s.nama AS student_name, 
                    c.kode_matkul, 
                    c.nama_matkul
                FROM t_enrollment e
                JOIN t_students s ON e.id_students = s.id_students
                JOIN t_course c ON e.id_course = c.id_course
                ORDER BY e.date_enrollment DESC";
        
        return $this->execute($query);

    }    

    function getEnrollmentById($id)
    {
        $query = "SELECT 
                    e.*, 
                    s.nim, 
                    s.nama AS student_name, 
                    c.kode_matkul, 
                    c.nama_matkul
                FROM t_enrollment e
                JOIN t_students s ON e.id_students = s.id_students
                JOIN t_course c ON e.id_course = c.id_course
                WHERE e.id_enrollment = $id";
        return $this->execute($query)->fetch_assoc();
    }

    function addEnrollment($data)
    {
        $student_id = $data['id_student'];
        $course_id = $data['id_course'];
        $enrollment_date = $data['date_enrollment'];
        $semester = $data['semester'];

        $query = "INSERT INTO t_enrollment VALUES (NULL, '$student_id', '$course_id', '$enrollment_date', '$semester', 0)";
        return $this->execute($query);
    }

    function updateEnrollment($id, $data)
    {
        $student_id = $data['id_students'];
        $course_id = $data['id_course'];
        $enrollment_date = $data['date_enrollment'];
        $semester = $data['semester'];
        $status = $data['status'];

        $query = "UPDATE t_enrollment 
                SET id_students = '$student_id', 
                    id_course = '$course_id', 
                    date_enrollment = '$enrollment_date', 
                    semester = '$semester',
                    status = '$status'
                WHERE id_enrollment = '$id'";

        return $this->execute($query);
    }



    function deleteEnrollment($id)
    {
        $query = "DELETE FROM t_enrollment WHERE id_enrollment = $id";
        return $this->execute($query);
    }

    function changeStatus($id)
    {
        $query = "UPDATE t_enrollment SET status = 1 WHERE id_enrollment = $id";
        return $this->execute($query);
    }

    function isEnrolled($student_id, $course_id, $semester)
    {
        $query = "SELECT * FROM t_enrollment WHERE id_students = '$student_id' AND id_course = '$course_id' AND semester = '$semester'";
        return $this->execute($query)->num_rows > 0;
    }
}
?>