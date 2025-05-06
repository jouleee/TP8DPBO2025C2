# Tugas Praktikum 8 DPBO - Sistem Akademik (MVC Pattern)

Tugas ini merupakan bagian dari Tugas Praktikum 8 mata kuliah **Desain Pemrograman Berorientasi Objek (DPBO)**. Pada praktikum ini, saya mengembangkan sebuah sistem informasi akademik sederhana berbasis PHP dengan arsitektur **MVC (Model-View-Controller)**.

## Janji

Saya Julian Dwi Satrio dengan NIM 2300484 mengerjakan Tugas Praktikum 8 dalam Mata Kuliah Desain Pemrograman Berorientasi Objek. Untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah di spesifikasikan. Aamiin.

## Desain Program

Program dibangun menggunakan pattern **MVC** untuk memisahkan logika aplikasi (Model), tampilan (View), dan pengendali alur (Controller). Adapun entitas utama yang digunakan:

- **Students** (Mahasiswa)
- **Course** (Mata Kuliah)
- **Enrollment** (Pendaftaran Mahasiswa ke Mata Kuliah)

## Struktur folder:
```
/project-root-directory
│
├── index.php # Entry point aplikasi, menangani routing dan aksi
├── controllers/ # Folder untuk controller
│ ├── Student.controller.php # Controller untuk mengelola data mahasiswa
│ ├── Course.controller.php # Controller untuk mengelola data mata kuliah
│ └── Enrollment.controller.php # Controller untuk mengelola data pendaftaran
│
├── models/ # Folder untuk model
│ ├── Student.php # Model untuk data mahasiswa
│ ├── Course.php # Model untuk data mata kuliah
│ └── Enrollment.php # Model untuk data pendaftaran
│
├── views/ # Folder untuk view
│ ├── StudentView.php # View untuk menampilkan data mahasiswa
│ ├── CourseView.php # View untuk menampilkan data mata kuliah
│ ├── EnrollmentView.php # View untuk menampilkan data pendaftaran
│ └── HomeView.php # View untuk halaman utama (home page)
│
├── template/ # Folder untuk template layout
│ └── layout.php # Template layout dasar untuk setiap halaman
│
├── database/
│ └── db_kampus.sql # database yang digunakan
│
└── assets/ # Folder untuk asset (CSS, JS, dan gambar, jika ada)
```

## Fitur Utama

- ✅ CRUD Mahasiswa
- ✅ CRUD Mata Kuliah
- ✅ CRUD Pendaftaran Mahasiswa ke Mata Kuliah
- ✅ Aktivasi status pendaftaran
- ✅ Halaman Home berisi navigasi ke tiap fitur (berbasis Bootstrap Card)

## Alur Program

1. **Routing (index.php)**  
   Menentukan halaman dan aksi yang diminta berdasarkan parameter `$_GET['page']` dan `$_GET['action']`.

2. **Controller**
   - Menerima request dari routing.
   - Menghubungi Model untuk mengakses atau memanipulasi data.
   - Memanggil View untuk merender tampilan.

3. **Model**
   - Bertanggung jawab terhadap interaksi dengan database.
   - Setiap entitas (Student, Course, Enrollment) memiliki modelnya masing-masing.

4. **View**
   - Bertugas merender halaman HTML.
   - Menggunakan template `layout.php` untuk konsistensi UI.

5. **Home Page**
   - Default page yang muncul saat membuka aplikasi.
   - Berisi 3 card menuju halaman Mahasiswa, Mata Kuliah, dan Pendaftaran.

## Dokumentasi 


https://github.com/user-attachments/assets/0fd02c03-4092-4a65-a181-18b17fc33d02

