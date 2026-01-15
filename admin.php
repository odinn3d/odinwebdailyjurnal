<?php
// start atau melanjutkan session
session_start();

include "koneksi.php";

// cek user login
if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JoJo Admin Panel</title>
    <link rel="icon" href="img/image.png">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* --- TEMA JOJO (DARK MODE) --- */
        body {
            background-color: #1e1e1e !important; /* Warna Gelap Index */
            color: #ffffff !important;
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Ungu Khas JoJo */
        .navbar {
            background-color: #38006b !important; /* Deep Purple */
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }

        /* Card (Kotak Dashboard/Artikel) */
        .card {
            background-color: #2d2d2d !important;
            border: 1px solid #6f42c1 !important; /* Garis Ungu */
            color: white !important;
        }

        /* Tabel Data */
        .table {
            color: white !important;
            border-color: #444 !important;
        }
        .table-hover tbody tr:hover {
            color: white !important;
            background-color: #38006b !important; /* Efek hover ungu */
        }
        .table thead {
            background-color: #6f42c1 !important;
            color: white !important;
        }

        /* Input Form & Textarea */
        .form-control {
            background-color: #2d2d2d !important;
            border: 1px solid #666 !important;
            color: white !important;
        }
        .form-control:focus {
            background-color: #333 !important;
            color: white !important;
            border-color: #a56cc1 !important;
            box-shadow: 0 0 0 0.25rem rgba(165, 108, 193, 0.25);
        }

        /* Modal (Popup) */
        .modal-content {
            background-color: #1e1e1e !important;
            border: 1px solid #6f42c1;
            color: white;
        }

        /* Judul Halaman */
        h4.display-6 {
            color: #d63384; /* Warna Pink JoJo */
            border-bottom-color: #d63384 !important;
        }

        /* Link Navigasi */
        .nav-link {
            color: #e0e0e0 !important;
        }
        .nav-link:hover {
            color: #ffc107 !important; /* Kuning Emas saat hover */
        }
        .nav-link.active {
            color: #ffc107 !important;
            font-weight: bold;
        }

        #content {
            flex: 1;
        }
        
        /* Footer */
        footer {
            background-color: #121212 !important;
            color: white !important;
            border-top: 1px solid #333;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-sm sticky-top navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href=".">
            <i class="bi bi-star-fill text-warning"></i> JoJo Fan Blog
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="admin.php?page=dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php?page=article">Article</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php?page=gallery">Gallery</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold text-warning" href="#" role="button"
                        data-bs-toggle="dropdown">
                        <?= $_SESSION['username']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li>
                            <a class="dropdown-item" href="admin.php?page=profile">
                                <i class="bi bi-person"></i> Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section id="content" class="p-5">
    <div class="container">
        <?php
        $page = $_GET['page'] ?? 'dashboard';
        $allowed_pages = ['dashboard', 'article', 'article_edit', 'gallery', 'gallery_edit', 'profile'];

        if (!in_array($page, $allowed_pages)) {
            $page = 'dashboard';
        }

        $judul = match ($page) {
            'dashboard'     => 'Dashboard',
            'article'       => 'Article Management',
            'article_edit'  => 'Edit Article',
            'gallery'       => 'Gallery Management',
            'gallery_edit'  => 'Edit Gallery',
            'profile'       => 'Profile Settings',
            default         => ''
        };

        if ($judul !== '') {
            echo '<h4 class="lead display-6 pb-2 border-bottom mb-4">' . $judul . '</h4>';
        }

        include $page . ".php";
        ?>
    </div>
</section>

<footer class="text-center p-3">
    <div>
        <a href="https://www.instagram.com/dinootp/" class="text-decoration-none">
            <i class="bi bi-instagram text-white" style="font-size: 24px;"></i>
        </a>
    </div>
    <div class="mt-2">
        JoJo Fan Blog &copy; 2025
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>