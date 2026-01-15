<?php
// dari file koneksi
include "koneksi.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JoJo Bizarre Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar,
        .card,
        #hero,
        #gallery,
        footer {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Tambahan Style untuk sentuhan JoJo */
        .text-jojo {
            color: #6a0dad; /* Warna Ungu Khas JoJo */
        }

        /* BARU: Background Ungu untuk Hero Section */
        .bg-ungu-jojo {
            background-color: #6a0dad !important;
            color: white !important;
        }
    </style>
</head>

<body>
    <nav id="navbar" class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a id="navbarBrand" class="navbar-brand fw-bold text-jojo" href="#">JoJo Universe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                    <li class="nav-item">
                        <a id="navHome" class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a id="navArticle" class="nav-link" href="#article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a id="navGallery" class="nav-link" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" target="_blank">Login</a>
                    </li> 
                    <li class="me-2">
                        <button id="btnDark" class="btn bg-dark text-white rounded-1 p-2">
                            <i class="bi bi-moon-stars-fill"></i>
                        </button>
                    </li>
                    <li>
                        <button id="btnLight" class="btn text-white rounded-1 p-2" style="background-color: #6a0dad;">
                            <i class="bi bi-brightness-high"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="hero" class="text-center p-5 p-3 mb-2 bg-ungu-jojo text-sm-start">
        <div class="container">
            <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <img src="img/jojo_banner.jpg" class="img-fluid" width="300" alt="JoJo Pose" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/JoJo%27s_Bizarre_Adventure_logo.png/640px-JoJo%27s_Bizarre_Adventure_logo.png'"> 
                
                <div>
                    <h1 id="heroTitle" class="fw-bold display-4">
                        Yare Yare Daze...
                    </h1>
                    <h4 id="heroSubtitle" class="lead display-6">
                        Catatan Petualangan para Pengguna Stand
                    </h4>
                    <h5 id="heroSubtitle" class="lead text-white">
   					 	Aldino Tegar Pratama l A11.2024.15928<br>
					</h5>
                    <div class="mt-3">
                        <span id="tanggal" class="fw-bold"></span>
                        <span id="jam" class="fw-bold text-warning"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="article" class="text-center p-5">
    <div class="container">
        <h1 class="fw-bold display-4 pb-3">JoJo Articles</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
        <?php
        $sql = "SELECT * FROM article ORDER BY tanggal desc";
        $hasil= $conn->query($sql);
        while($row=$hasil->fetch_assoc()){
        ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="img/<?=$row["gambar"]?>" class="card-img-top" alt="..." style="height:200px; object-fit:cover;" />
                    <div class="card-body">
                        <h5 class="card-title"><?=$row["judul"]?></h5>
                        <p class="card-text">
                            <?=$row["isi"]?>
                        </p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <small class="text-body-secondary">Updated: <?=$row["tanggal"]?></small>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
    </section>

    <section id="gallery" class="text-center p-5 p-3 mb-2 bg-light">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Stand Gallery</h1>

            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                <?php
                $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
                $hasil = $conn->query($sql);
                $active = "active";

                while ($row = $hasil->fetch_assoc()) {
                ?>
                    <div class="carousel-item <?= $active ?>">
                        <img src="img/<?= $row['gambar']; ?>" class="d-block w-100 rounded" style="max-height: 500px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                            <p><?= $row['tanggal']; ?></p>
                        </div>
                    </div>
                <?php
                    $active = ""; 
                }
                ?>

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


    <footer id="footer" class="text-center p-5">
        <div>
            <a href="https://www.instagram.com/dinootp/" class="text-decoration-none text-dark">
                <i id="igIcon" class="bi bi-instagram" style="font-size: 24px;"></i>
            </a>
        </div>
        <div id="footerText" class="mt-2">
            JoJo Fan Blog &copy; 2025
        </div>
    </footer>

    <button id="backToTop" class="btn btn-danger rounded-circle position-fixed bottom-0 end-0 m-3 d-none">
        <i class="bi bi-arrow-up" title="Back to Top"></i>
    </button>

    <script type="text/javascript">
        function TampilWaktu() {
            const waktu = new Date();
            const tanggal = waktu.getDate();
            const bulan = waktu.getMonth();
            const tahun = waktu.getFullYear();
            const jam = waktu.getHours();
            const menit = waktu.getMinutes();
            const detik = waktu.getSeconds();

            const arrBulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"];
            const tanggal_full = tanggal + " " + arrBulan[bulan] + " " + tahun;
            const jam_full = jam + ":" + menit + ":" + detik;

            document.getElementById("tanggal").innerHTML = tanggal_full;
            document.getElementById("jam").innerHTML = " | " + jam_full;
        }
        setInterval(TampilWaktu, 1000);
    </script>

    <script type="text/javascript">
        const backToTop = document.getElementById("backToTop");

        window.addEventListener("scroll", function () {
            if (window.scrollY > 300) {
                backToTop.classList.remove("d-none");
                backToTop.classList.add("d-block");
            } else {
                backToTop.classList.remove("d-block");
                backToTop.classList.add("d-none");
            }
        });

        backToTop.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    </script>

<script>
    //dark mode
    document.getElementById("btnDark").onclick = function () {
        document.body.style.backgroundColor = "#121212"; // Hitam Pekat
        document.body.style.color = "white";

        const navbar = document.getElementById("navbar");
        navbar.style.backgroundColor = "#0d0d0d";
        navbar.classList.remove("bg-white");
        navbar.classList.add("bg-dark");

        document.getElementById("navbarBrand").style.color = "#d63384"; // Pink Jojo di dark mode

        //navbar links
        document.querySelectorAll(".nav-link").forEach(link => {
            link.style.color = "white";
        });

        // Hero Section di Dark Mode (Dari Ungu -> Gelap)
        const hero = document.getElementById("hero");
        hero.classList.remove("bg-ungu-jojo"); // Hapus warna ungu
        hero.classList.add("bg-dark", "text-white"); // Ganti hitam

        // Gallery Section di Dark Mode
        const gallery = document.getElementById("gallery");
        gallery.classList.remove("bg-light");
        gallery.style.backgroundColor = "#2c2c2c";
        gallery.style.color = "white";

        const footer = document.getElementById("footer");
        footer.style.backgroundColor = "#121212";
        
        document.getElementById("igIcon").style.color = "white";
        document.getElementById("footerText").style.color = "white";
    };

    //light mode
    document.getElementById("btnLight").onclick = function () {
        document.body.style.backgroundColor = "white";
        document.body.style.color = "black";

        const navbar = document.getElementById("navbar");
        navbar.style.backgroundColor = "white";
        navbar.classList.remove("bg-dark");
        navbar.classList.add("bg-white");

        document.getElementById("navbarBrand").style.color = "#6a0dad"; // Ungu Jojo di light mode

        //navbar links
        document.querySelectorAll(".nav-link").forEach(link => {
            link.style.color = "black";
        });

        // Hero Section di Light Mode (BALIK KE UNGU)
        const hero = document.getElementById("hero");
        hero.classList.remove("bg-dark", "text-white");
        hero.classList.add("bg-ungu-jojo"); // Balik ke Ungu lagi

        // Gallery Section di Light Mode
        const gallery = document.getElementById("gallery");
        gallery.style.backgroundColor = "#f8f9fa"; // Balik ke warna terang
        gallery.style.color = "black";

        const footer = document.getElementById("footer");
        footer.style.backgroundColor = "white";

        document.getElementById("igIcon").style.color = "black";
        document.getElementById("footerText").style.color = "black";
    };
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>