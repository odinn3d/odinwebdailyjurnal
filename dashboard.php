<?php

$qArticle = $conn->query("SELECT id FROM article");
$jumlah_article = $qArticle->num_rows;

$qGallery = $conn->query("SELECT id FROM gallery");
$jumlah_gallery = $qGallery->num_rows;


$username = $_SESSION['username'];


$qUser = $conn->prepare("SELECT foto FROM user WHERE username = ?");
$qUser->bind_param("s", $username);
$qUser->execute();
$user = $qUser->get_result()->fetch_assoc();

$foto = $user['foto'] ?? 'default.png';
?>

<div class="container text-center">

    <p class="fs-5 mt-4">Selamat Datang,</p>
    <h3 class="fw-bold text-danger"><?= $username; ?></h3>

    <!-- FOTO PROFIL -->
    <img src="img/<?= $foto; ?>"
         class="rounded-circle my-3"
         width="160" height="160"
         style="object-fit:cover;">

    <!-- CARD STATISTIK -->
    <div class="row justify-content-center mt-4 g-4">

        <!-- ARTICLE -->
        <div class="col-md-4 col-lg-3">
            <a href="admin.php?page=article" class="text-decoration-none">
                <div class="card shadow border border-danger h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-newspaper fs-4"></i>
                            <span class="ms-2 fw-semibold">Article</span>
                        </div>
                        <span class="badge rounded-pill bg-danger fs-5">
                            <?= $jumlah_article; ?>
                        </span>
                    </div>
                </div>
            </a>
        </div>

        <!-- GALLERY -->
        <div class="col-md-4 col-lg-3">
            <a href="admin.php?page=gallery" class="text-decoration-none">
                <div class="card shadow border border-danger h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-camera fs-4"></i>
                            <span class="ms-2 fw-semibold">Gallery</span>
                        </div>
                        <span class="badge rounded-pill bg-danger fs-5">
                            <?= $jumlah_gallery; ?>
                        </span>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
