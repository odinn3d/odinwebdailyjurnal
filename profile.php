<?php
if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
}

include "koneksi.php";
include "upload_foto.php";

$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM user WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (isset($_POST['simpan'])) {

    $password_baru = $_POST['password'];
    $foto_lama = $user['foto'];
    $foto_baru = $foto_lama;

    if (!empty($_FILES['foto']['name'])) {
        $upload = upload_foto($_FILES['foto']);
        if ($upload['status']) {
            $foto_baru = $upload['message'];
            if ($foto_lama && file_exists("img/".$foto_lama)) {
                unlink("img/".$foto_lama);
            }
        } else {
            echo "<script>alert('{$upload['message']}')</script>";
            exit;
        }
    }

    if ($password_baru != '') {
        $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
        $stmt = $conn->prepare(
            "UPDATE user SET password=?, foto=? WHERE username=?"
        );
        $stmt->bind_param("sss", $password_hash, $foto_baru, $username);
    } else {
        $stmt = $conn->prepare(
            "UPDATE user SET foto=? WHERE username=?"
        );
        $stmt->bind_param("ss", $foto_baru, $username);
    }

    $stmt->execute();
    $stmt->close();

    echo "<script>
        alert('Profile berhasil diperbarui');
        location='admin.php?page=profile';
    </script>";
}
?>

<!-- FORM PROFILE -->
<div class="row mt-4">
    <div class="col-md-8">

        <form method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control"
                       value="<?= $user['username']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Ganti Password</label>
                <input type="password" name="password" class="form-control"
                       placeholder="Tuliskan Password Baru Jika Ingin Mengganti Password Saja">
            </div>

            <div class="mb-3">
                <label class="form-label">Ganti Foto Profil</label>
                <input type="file" name="foto" class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Foto Profil Saat Ini</label><br>
                <?php if ($user['foto']) : ?>
                    <img src="img/<?= $user['foto']; ?>"
                         style="width:120px;height:120px;object-fit:cover"
                         class="rounded shadow mt-2">
                <?php else : ?>
                    <span class="text-muted">Belum ada foto</span>
                <?php endif; ?>
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">
                simpan
            </button>

        </form>

    </div>
</div>
