<?php
class HomeView {
    public function renderHome() {
        $title = "Homepage";
        $page = "home";
        ob_start();
        ?>
        <h2>Selamat Datang di Sistem Informasi Akademik</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Mahasiswa</h5>
                        <p class="card-text">Kelola data mahasiswa di sini.</p>
                        <a href="index.php?page=students" class="btn btn-primary">Lihat Mahasiswa</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Mata Kuliah</h5>
                        <p class="card-text">Kelola data mata kuliah.</p>
                        <a href="index.php?page=course" class="btn btn-primary">Lihat Mata Kuliah</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Pendaftaran</h5>
                        <p class="card-text">Kelola pendaftaran mata kuliah.</p>
                        <a href="index.php?page=enrollment" class="btn btn-primary">Lihat Pendaftaran</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $content = ob_get_clean();
        include "template/layout.php";
    }
}
?>
