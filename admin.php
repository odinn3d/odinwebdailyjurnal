<?php 
//start atau melanjutkan session
session_start(); 

include "koneksi.php";

//check user login
if (!isset($_SESSION['username'])) { 
	header("location:login.php"); 
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lilypedia | Aldino Tegar</title>
	  <link rel="icon" href="img/image.png">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    #content {
        flex: 1;
    }
</style>
  </head>
  <body>
  <!-- nav begin -->
  <nav class="navbar navbar-expand-sm sticky-top navbar-dark bg-secondary">
    <div class="container">
      <a class="navbar-brand text-white" target="_blank" href=".">
        Lilypedia Admin
      </a>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
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
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle text-danger fw-bold"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <?= $_SESSION['username'] ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
</nav>
	<!-- nav end -->

	<!-- content begin -->
    <section id="content" class="p-5">
        <div class="container"> 
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "dashboard";
            }

            echo '<h4 class="lead display-6 pb-2 border-bottom border-danger-subtle">' . $page . '</h4>';
            include($page . ".php");
            ?>
        </div> 
    </section>
    <!-- content end -->
	
	<!-- footer begin -->
    <footer class="text-center p-3 bg-secondary">
			<div>
				<a href="https://instagram.com/dinootp">
					<i id="igIcon" class="bi bi-instagram text-white" style="font-size: 24px;"></i>
				</a>
			</div>
			<div class="text-white">Aldino Tegar Pratama &copy; 2025</div>
    </footer>
    <!-- footer end -->

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"
  ></script>
</body>
</html>
