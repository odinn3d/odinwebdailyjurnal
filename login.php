<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['username'])) {
    header("location:admin.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['user']);
    $password = trim($_POST['pass']);

    if ($username == "" || $password == "") {
        $error = "Username dan Password tidak boleh kosong!";
    } else {

        $stmt = $conn->prepare("SELECT * FROM user WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

           
		if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                header("location:admin.php");
                exit;
            } else {
                $error = "Username atau Password salah!";
            }

        } else {
            $error = "Username atau Password salah!";
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login | My Daily Journal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            min-height: 100vh;
            background-color: #6c757d;
        }

        .login-wrapper {
            margin-top: 80px; 
        }

        .login-card {
            max-width: 420px;
            margin: auto;
        }
    </style>
</head>

<body>

<div class="login-wrapper">
    <div class="login-card">
        <div class="card border-0 shadow rounded-4">
            <div class="card-body p-4">

                <div class="text-center mb-4">
                    <i class="bi bi-person-circle display-3"></i>
                    <h5 class="fw-bold mt-2">My Daily Journal</h5>
                    <hr>
                </div>

                <?php if ($error != "") : ?>
                    <div class="alert alert-danger text-center">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <form method="post">
                    <input 
                        type="text" 
                        name="user" 
                        class="form-control mb-3 rounded-4"
                        placeholder="Username"
                        required>

                    <input 
                        type="password" 
                        name="pass" 
                        class="form-control mb-3 rounded-4"
                        placeholder="Password"
                        required>

                    <div class="d-grid">
                        <button class="btn btn-danger rounded-4">
                            Login
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
