<?php
session_start();
include "koneksi.php";

// login arahkan ke admin
if (isset($_SESSION['username'])) {
    header("location:admin.php");
    exit;
}

$error = "";

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userInput = trim($_POST['user']);
    $passInput = trim($_POST['pass']);

    if ($userInput == "" || $passInput == "") {
        $error = "Username dan Password tidak boleh kosong!";
    } else {

        $username = $userInput;
        $password = md5($passInput); 

        $stmt = $conn->prepare(
            "SELECT * FROM user WHERE username=? AND password=?"
        );
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            header("location:admin.php");
            exit;
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-secondary">

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body">

                    <div class="text-center mb-3">
                        <i class="bi bi-person-circle display-4"></i>
                        <p class="fw-bold">My Daily Journal</p>
                        <hr>
                    </div>

                    <?php if ($error != "") { ?>
                        <div class="alert alert-danger text-center">
                            <?= $error ?>
                        </div>
                    <?php } ?>

                    <form method="post" id="LoginForm">
                        <input 
                            type="text" 
                            name="user" 
                            id="user"
                            class="form-control my-3 rounded-4"
                            placeholder="Username">

                        <input 
                            type="password" 
                            name="pass" 
                            id="pass"
                            class="form-control my-3 rounded-4"
                            placeholder="Password">

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
</div>

<script>
document.getElementById("LoginForm").addEventListener("submit", function(event) {
    const user = document.getElementById("user").value.trim();
    const pass = document.getElementById("pass").value.trim();

    if (user === "" || pass === "") {
        alert("Username dan Password tidak boleh kosong!");
        event.preventDefault();
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
