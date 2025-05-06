<?php
include_once "models/DB.class.php";

class Student extends DB{
    function getStudent()
    {
        $query = "SELECT * FROM t_students";
        return $this->execute($query);
    }

    function getStudentById($id)
    {
        $query = "SELECT * FROM t_students WHERE id_students = $id";
        return $this->execute($query);
    }

    function addStudent($data)
    {
        $name = $data['name'];
        $nim = $data['nim'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];

        $query = "INSERT INTO `t_students` (`id_students`, `nama`, `nim`, `phone`, `join_date`) VALUES (NULL, '$name', '$nim', '$phone', '$join_date');";
        return $this->execute($query);
    }

    function updateStudent($data)
    {
        $id = $data['id'];
        $name = $data['name'];
        $nim = $data['nim'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];

        $query = "UPDATE t_students SET nama = '$name', nim = '$nim', phone = '$phone', join_date = '$join_date' WHERE id_students = $id";
        return $this->execute($query);
    }

    function deleteStudent($id)
    {
        $query = "DELETE FROM t_students WHERE id_students = $id";
        return $this->execute($query);
    }
}
?>