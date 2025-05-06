<?php
class EnrollmentView {
    public function renderIndex($enrollment) {
        $title = "Daftar Pendaftaran Mata Kuliah";
        $page = "enrollment";
        ob_start();
        ?>

        <div class="d-flex justify-content-between mb-3">
            <h2>Data Pendaftaran Mata Kuliah</h2>
            <a href="index.php?page=enrollment&action=create" class="btn btn-primary">Add New</a>
        </div>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>Semester</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($enrollment)): ?>
                    <tr>
                        <td colspan="8">
                            <div class="alert alert-info text-center m-0">
                                Belum ada data mahasiswa. Silakan tambahkan data baru.
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($enrollment as $row): ?>
                        <tr>
                            <td><?= $row['nim'] ?></td>
                            <td><?= $row['student_name'] ?></td>
                            <td><?= $row['kode_matkul'] ?></td>
                            <td><?= $row['nama_matkul'] ?></td>
                            <td><?= $row['semester'] ?></td>
                            <td><?= $row['date_enrollment'] ?></td>
                            <td>
                                <?php if ($row['status'] == 1): ?>
                                    <span class="badge bg-success">Sudah Acc</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Belum Acc</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="index.php?page=enrollment&action=edit&id=<?= $row['id_enrollment'] ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="index.php?page=enrollment&action=delete&id=<?= $row['id_enrollment'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                                <?php if ($row['status'] != 1): ?>
                                    <a href="index.php?page=enrollment&action=changeStatus&id=<?= $row['id_enrollment'] ?>&status=1" class="btn btn-info btn-sm">Setujui</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <?php
        $content = ob_get_clean();
        include "template/layout.php";
    }

    public function renderCreate($students, $courses) {
        $title = "Tambah Pendaftaran Mata Kuliah";
        $page = "enrollment";
        ob_start();
        ?>
        <h2>Tambah Pendaftaran Mata Kuliah</h2>

        <?php if (empty($students) || empty($courses)): ?>
            <div class="alert alert-info">
                Data mahasiswa atau mata kuliah belum tersedia. Silakan tambahkan terlebih dahulu.
            </div>
        <?php else: ?>
            <form action="index.php?page=enrollment&action=store" method="POST">
                <div class="mb-3">
                    <label for="id_student" class="form-label">Mahasiswa</label>
                    <select class="form-select" name="id_student" required>
                        <option value="">Pilih Mahasiswa</option>
                        <?php foreach ($students as $student): ?>
                            <option value="<?= $student['id_students'] ?>"><?= $student['nim'] ?> - <?= $student['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_course" class="form-label">Mata Kuliah</label>
                    <select class="form-select" name="id_course" required>
                        <option value="">Pilih Mata Kuliah</option>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?= $course['id_course'] ?>"><?= $course['kode_matkul'] ?> - <?= $course['nama_matkul'] ?> (<?= $course['sks'] ?> SKS)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="number" class="form-control" name="semester" required>
                </div>
                <div class="mb-3">
                    <label for="date_enrollment" class="form-label">Tanggal Daftar</label>
                    <input type="date" class="form-control" name="date_enrollment" value="<?= date('Y-m-d') ?>">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        <?php endif; ?>

        <?php
        $content = ob_get_clean();
        include "template/layout.php";
    }

    public function renderUpdate($enrollment, $students, $courses) {
        $title = "Edit Pendaftaran Mata Kuliah";
        $page = "enrollment";
        ob_start();
        ?>
        <h2>Edit Pendaftaran Mata Kuliah</h2>

        <?php if (empty($students) || empty($courses)): ?>
            <div class="alert alert-info">
                Data mahasiswa atau mata kuliah belum tersedia. Silakan tambahkan terlebih dahulu.
            </div>
        <?php else: ?>
            <form action="index.php?page=enrollment&action=update&id=<?= $enrollment['id_enrollment'] ?>" method="POST">
                <div class="mb-3">
                    <label for="id_student" class="form-label">Mahasiswa</label>
                    <select class="form-select" name="id_student" required>
                        <option value="">Pilih Mahasiswa</option>
                        <?php foreach ($students as $student): ?>
                            <option value="<?= $student['id_students'] ?>" <?= ($student['id_students'] == $enrollment['id_students']) ? 'selected' : '' ?>>
                                <?= $student['nim'] ?> - <?= $student['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_course" class="form-label">Mata Kuliah</label>
                    <select class="form-select" name="id_course" required>
                        <option value="">Pilih Mata Kuliah</option>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?= $course['id_course'] ?>" <?= ($course['id_course'] == $enrollment['id_course']) ? 'selected' : '' ?>>
                                <?= $course['kode_matkul'] ?> - <?= $course['nama_matkul'] ?> (<?= $course['sks'] ?> SKS)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="number" class="form-control" name="semester" value="<?= $enrollment['semester'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" name="status" required>
                        <option value="1" <?= ($enrollment['status'] == 1) ? 'selected' : '' ?>>Sudah Acc</option>
                        <option value="0" <?= ($enrollment['status'] == 0) ? 'selected' : '' ?>>Belum Acc</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date_enrollment" class="form-label">Tanggal Daftar</label>
                    <input type="date" class="form-control" name="date_enrollment" value="<?= $enrollment['date_enrollment'] ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        <?php endif; ?>

        <?php
        $content = ob_get_clean();
        include "template/layout.php";
    }
}
?>
