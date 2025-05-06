<?php
class CourseView {
    public function renderIndex($course) {
        $title = "Daftar Mata Kuliah";
        $page = "course";
        ob_start();
        ?>
        <div class="d-flex justify-content-between mb-3">
            <h2>Data Mata Kuliah</h2>
            <a href="index.php?page=course&action=create" class="btn btn-primary">Add New</a>
        </div>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($course as $row): ?>
                    <tr>
                        <td><?= $row['kode_matkul'] ?></td>
                        <td><?= $row['nama_matkul'] ?></td>
                        <td><?= $row['sks'] ?></td>
                        <td>
                            <a href="index.php?page=course&action=edit&id=<?= $row['id_course'] ?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="index.php?page=course&action=delete&id=<?= $row['id_course'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        $content = ob_get_clean();
        include "template/layout.php";
    }

    public function renderCreate() {
        $title = "Tambah Mata Kuliah";
        $page = "course";
        ob_start();
        ?>
        <h2>Tambah Data Mata Kuliah</h2>
        <form action="index.php?page=course&action=store" method="POST">
            <div class="mb-3">
                <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                <input type="text" class="form-control" name="nama_matkul" required>
            </div>
            <div class="mb-3">
                <label for="kode_matkul" class="form-label">Kode Mata Kuliah</label>
                <input type="text" class="form-control" name="kode_matkul" required>
            </div>
            <div class="mb-3">
                <label for="sks" class="form-label">SKS</label>
                <input type="number" class="form-control" name="sks" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <?php
        $content = ob_get_clean();
        include "template/layout.php";
    }

    public function renderUpdate($course) {
        $title = "Edit Mata Kuliah";
        $page = "course";
        ob_start();
        ?>
        <h2>Edit Data Mata Kuliah</h2>
        <form action="index.php?page=course&action=update&id=<?= $course['id_course'] ?>" method="POST">
            <div class="mb-3">
                <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                <input type="text" class="form-control" name="nama_matkul" value="<?= $course['nama_matkul'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="kode_matkul" class="form-label">Kode Mata Kuliah</label>
                <input type="text" class="form-control" name="kode_matkul" value="<?= $course['kode_matkul'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="sks" class="form-label">SKS</label>
                <input type="number" class="form-control" name="sks" value="<?= $course['sks'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <?php
        $content = ob_get_clean();
        include "template/layout.php";
    }
}
?>