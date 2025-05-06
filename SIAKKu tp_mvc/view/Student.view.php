<?php
class StudentView {
    public function renderIndex($students) {
        $title = "Daftar Mahasiswa";
        $page = "students";
        ob_start();
        ?>
        <div class="d-flex justify-content-between mb-3">
            <h2>Data Mahasiswa</h2>
            <a href="index.php?page=students&action=create" class="btn btn-primary">Add New</a>
        </div>
        
        <?php if (empty($students)): ?>
            <div class="alert alert-info">
                Belum ada data mahasiswa. Silakan tambahkan data baru.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Kontak</th>
                            <th>Tanggal Masuk</th>
                            <th width="180px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $row): ?>
                            <tr>
                                <td><?= $row['nim'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['phone'] ?></td>
                                <td><?= date('d F Y', strtotime($row['join_date'])) ?></td>
                                <td>
                                    <a href="index.php?page=students&action=edit&id=<?= $row['id_students'] ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="index.php?page=students&action=delete&id=<?= $row['id_students'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data <?= $row['nama'] ?>?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        <?php
        $content = ob_get_clean();
        include "template/layout.php";
    }

    public function renderCreate() {
        $title = "Tambah Mahasiswa";
        $page = "students";
        ob_start();
        ?>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah Data Mahasiswa</h5>
            </div>
            <div class="card-body">
                <form action="index.php?page=students&action=store" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" name="nim" id="nim" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                    </div>
                    <div class="mb-3">
                        <label for="join_date" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="join_date" id="join_date" value="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php?page=students" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
        $content = ob_get_clean();
        include "template/layout.php";
    }

    public function renderUpdate($student) {
        $title = "Edit Mahasiswa";
        $page = "students";
        ob_start();
        ?>
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Edit Data Mahasiswa</h5>
            </div>
            <div class="card-body">
                <form action="index.php?page=students&action=update&id=<?= $student['id_students'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?= $student['nama'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" name="nim" id="nim" value="<?= $student['nim'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="<?= $student['phone'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="join_date" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="join_date" id="join_date" value="<?= $student['join_date'] ?>">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php?page=students" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
        $content = ob_get_clean();
        include "template/layout.php";
    }
}
?>