<?php
include_once "models/DB.class.php";

class Course extends DB{
    function getCourse()
    {
        $query = "SELECT * FROM t_course";
        return $this->execute($query);
    }

    function getCourseById($id)
    {
        $query = "SELECT * FROM t_course WHERE id_course = $id";
        return $this->execute($query);
    }

    function addCourse($data)
    {
        $nama = $data['nama_matkul'];
        $kode = $data['kode_matkul'];
        $sks = $data['sks'];

        $query = "INSERT INTO t_course VALUES (NULL, '$nama', '$kode', '$sks')";
        return $this->execute($query);
    }

    function updateCourse($data)
    {
        $id = $data['id'];
        $nama = $data['nama_matkul'];
        $kode = $data['kode_matkul'];
        $sks = $data['sks'];

        $query = "UPDATE t_course SET nama_matkul = '$nama', kode_matkul = '$kode', sks = '$sks' WHERE id_course = $id";
        return $this->execute($query);
    }

    function deleteCourse($id)
    {
        $query = "DELETE FROM t_course WHERE id_course = $id";
        return $this->execute($query);
    }
}
?>