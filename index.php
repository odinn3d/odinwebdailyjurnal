<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Jenis Bunga Lily Terlengkap & Makna Warnanya | Lilypedia oleh Aldino Tegar</title>

  <meta name="description" content="Pelajari berbagai jenis bunga lily beserta makna warnanya. Website oleh Aldino Tegar Pratama.">
  <meta name="keywords" content="bunga lily, jenis lily, makna warna lily">
  <meta name="author" content="Aldino Tegar Pratama">

  <link rel="icon" type="image/png" href="img/logo.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fdf7fa;
      color: #333;
      transition: background-color 0.3s, color 0.3s;
    }
    header {
      background: linear-gradient(135deg, #fbd6e3, #d4e3fc);
      text-align: center;
      padding: 80px 20px;
    }
    nav { background-color: #f5cde0; }
    nav a.nav-link { color: #333 !important; font-weight: 500; }
    nav a.nav-link:hover { color: #d63384 !important; }
    section { padding: 60px 20px; }
    .carousel-inner img {
      border-radius: 20px;
      max-height: 500px;
      object-fit: cover;
    }
    footer {
      background: #fdeff4;
      padding: 30px;
      text-align: center;
      border-top: 1px solid #e8cde0;
    }

    .accordion-button:not(.collapsed) {
        background-color: #dc3545;
        color: #fff;
    }
    
    /* Style untuk gambar artikel agar seragam */
    .card-img-top {
        height: 250px;
        object-fit: cover;
    }

    /* --- DARK MODE CSS --- */
    body.dark-mode {
      background-color: #121212 !important;
      color: #e0e0e0 !important;
    }
    body.dark-mode nav {
      background-color: #1f1f1f !important;
      border-bottom: 1px solid #333;
    }
    body.dark-mode nav a.nav-link {
      color: #e0e0e0 !important;
    }
    body.dark-mode header {
      background: linear-gradient(135deg, #2c0b16, #091629) !important;
      color: #fff;
    }
    body.dark-mode .bg-light {
      background-color: #1e1e1e !important;
      color: #e0e0e0 !important;
    }
    body.dark-mode .card {
      background-color: #2c2c2c;
      color: #fff;
      border: 1px solid #444;
    }
    body.dark-mode footer {
      background-color: #1a1a1a;
      border-top: 1px solid #333;
      color: #ccc;
    }
    body.dark-mode .accordion-item {
      background-color: #2c2c2c;
      color: #fff;
      border-color: #444;
    }
    body.dark-mode .accordion-button {
      background-color: #2c2c2c;
      color: #fff;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">Lilypedia</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
          <li class="nav-item"><a class="nav-link" href="#article">Artikel</a></li>
          <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="#schedule">Schedule</a></li>
          <li class="nav-item"><a class="nav-link" href="#aboutme">About Me</a></li>
          
          <li class="nav-item">
              <a class="nav-link fw-bold text-danger" href="login.php" target="_blank">Login</a>
          </li>

          <li class="nav-item ms-2">
            <button id="btn-dark" class="btn btn-dark btn-sm me-1" title="Dark Mode">
              <i class="bi bi-moon-stars-fill"></i>
            </button>
            <button id="btn-light" class="btn btn-light btn-sm border" title="Light Mode">
              <i class="bi bi-sun-fill"></i>
            </button>
          </li>
          </ul>
      </div>
    </div>
  </nav>

  <header id="home">
    <h1 class="fw-bold">Keindahan Jenis-Jenis Bunga Lily</h1>
    <p class="lead">Website oleh Aldino Tegar Pratama | A11.2024.15928</p>

    <div class="mt-3">
       <h5 class="p-2 border rounded-3 d-inline-block shadow-sm bg-white text-dark">
         <span id="tanggal"></span> | <span id="jam"></span>
       </h5>
    </div>
    </header>

  <section id="about" class="text-center">
    <div class="container">
      <h2 class="fw-bold mb-4">Tentang Bunga Lily</h2>
      <p class="fs-5">Bunga lily dikenal sebagai simbol keanggunan, kemurnian, dan cinta. Tanaman ini memiliki berbagai warna yang masing-masing menyimpan makna mendalam.</p>
    </div>
  </section>

  <section id="article" class="bg-light text-center">
    <div class="container">
      <h2 class="fw-bold mb-5">Artikel Terbaru</h2>
      
      <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
        <?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql);

        while($row = $hasil->fetch_assoc()){
        ?>
            <div class="col">
              <div class="card h-100 shadow-sm">
                <img src="img/<?= $row["gambar"] ?>" class="card-img-top" alt="<?= $row["judul"] ?>">
                <div class="card-body">
                  <h5 class="card-title"><?= $row["judul"] ?></h5>
                  <p class="card-text">
                    <?= $row["isi"] ?>
                  </p>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <small class="text-body-secondary">Diposting: <?= $row["tanggal"] ?></small>
                </div>
              </div>
            </div>
        <?php
        }
        ?>
      </div>
      
    </div>
  </section>

  <section id="gallery" class="text-center">
    <div class="container">
      <h2 class="fw-bold mb-4">Gallery Bunga Lily</h2>
      <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active"><img src="img/lily1.jpg" class="d-block w-100" alt="Lily putih"></div>
          <div class="carousel-item"><img src="img/lily2.jpg" class="d-block w-100" alt="Lily merah"></div>
          <div class="carousel-item"><img src="img/lily3.jpg" class="d-block w-100" alt="Lily kuning"></div>
          <div class="carousel-item"><img src="img/lily4.jpg" class="d-block w-100" alt="Lily pink"></div>
          <div class="carousel-item"><img src="img/lily5.jpg" class="d-block w-100" alt="Lily oranye"></div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
  </section>

  <section id="schedule" class="text-center py-5 bg-light">
    <div class="container">
      <h2 class="fw-bold mb-4">Schedule</h2>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
        <div class="col">
          <div class="card p-4 shadow-sm">
            <i class="bi bi-book fs-1 text-danger mb-3"></i>
            <h5 class="fw-bold">Membaca</h5>
            <p>Menambah wawasan setiap pagi sebelum beraktivitas.</p>
          </div>
        </div>
        <div class="col">
          <div class="card p-4 shadow-sm">
            <i class="bi bi-pen fs-1 text-danger mb-3"></i>
            <h5 class="fw-bold">Menulis</h5>
            <p>Mencatat setiap pengalaman harian di jurnal pribadi.</p>
          </div>
        </div>
        <div class="col">
          <div class="card p-4 shadow-sm">
            <i class="bi bi-chat-dots fs-1 text-danger mb-3"></i>
            <h5 class="fw-bold">Diskusi</h5>
            <p>Bertukar ide dengan teman dalam kelompok belajar.</p>
          </div>
        </div>
        <div class="col">
          <div class="card p-4 shadow-sm">
            <i class="bi bi-bicycle fs-1 text-danger mb-3"></i>
            <h5 class="fw-bold">Olahraga</h5>
            <p>Menjaga kebugaran tubuh setiap sore hari.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="aboutme" class="mt-5 py-5" style="background-color: #ffe1e1;">
    <div class="container">
      <h2 class="fw-bold text-center mb-4">About Me</h2>
      <div class="accordion" id="aboutAccordion">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#edu1">
              Universitas Dian Nuswantoro Semarang (2024–Now)
            </button>
          </h2>
          <div id="edu1" class="accordion-collapse collapse show" data-bs-parent="#aboutAccordion">
            <div class="accordion-body">
              Mahasiswa aktif Program Studi Teknik Informatika. Fokus belajar Web Development dan Programming.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#edu2">
              SMA Negeri 1 Rembang (2021–2023)
            </button>
          </h2>
          <div id="edu2" class="accordion-collapse collapse" data-bs-parent="#aboutAccordion">
            <div class="accordion-body">
              Lulusan SMA Negeri 1 Rembang, aktif dalam pembelajaran akademik.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="contact" class="text-center bg-light">
    <div class="container">
      <h2 class="fw-bold mb-3">Hubungi Saya</h2>
      <p>Hubungi melalui media sosial berikut:</p>
      <a href="https://instagram.com/dinootp" class="text-dark fs-3 p-2"><i class="bi bi-instagram"></i></a>
      <a href="https://wa.me/6289529742295" class="text-dark fs-3 p-2"><i class="bi bi-whatsapp"></i></a>
    </div>
  </section>

  <footer>
    <p class="mb-0">&copy; 2025 Aldino Tegar Pratama — All Rights Reserved 🌸</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    const btnDark = document.getElementById("btn-dark");
    const btnLight = document.getElementById("btn-light");

    btnDark.addEventListener("click", function() {
      document.body.classList.add("dark-mode");
    });

    btnLight.addEventListener("click", function() {
      document.body.classList.remove("dark-mode");
    });
  </script>
  <script type="text/javascript">
    window.setTimeout("tampilWaktu()", 1000);

    function tampilWaktu() {
        var waktu = new Date();
        var bulan = waktu.getMonth();
        var tanggal = waktu.getDate();
        var tahun = waktu.getFullYear();
        var jam = waktu.getHours();
        var menit = waktu.getMinutes();
        var detik = waktu.getSeconds();
        
        var namaBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        // Menambahkan angka 0 jika jam/menit/detik kurang dari 10
        if (jam < 10) { jam = "0" + jam; }
        if (menit < 10) { menit = "0" + menit; }
        if (detik < 10) { detik = "0" + detik; }

        var tampilTanggal = tanggal + " " + namaBulan[bulan] + " " + tahun;
        var tampilJam = jam + ":" + menit + ":" + detik;

        document.getElementById("tanggal").innerHTML = tampilTanggal;
        document.getElementById("jam").innerHTML = tampilJam;
        
        setTimeout("tampilWaktu()", 1000);
    }
    
    // Jalankan fungsi sekali saat pertama kali load
    tampilWaktu();
  </script>
</body>
</html>