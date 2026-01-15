<?php
session_start();
include "koneksi.php";
include "upload_foto.php";

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("location:admin.php?page=article");
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM article WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar_lama = $_POST['gambar_lama'];
    $gambar = $gambar_lama;

    if ($_FILES['gambar']['name'] != '') {
        $upload = upload_foto($_FILES['gambar']);
        if ($upload['status']) {
            if ($gambar_lama != '') {
                unlink("img/" . $gambar_lama);
            }
            $gambar = $upload['message'];
        } else {
            echo "<script>alert('{$upload['message']}')</script>";
        }
    }

    $stmt = $conn->prepare(
        "UPDATE article SET judul=?, isi=?, gambar=?, tanggal=?, username=? WHERE id=?"
    );
    $stmt->bind_param("sssssi", $judul, $isi, $gambar, $tanggal, $username, $id);
    $stmt->execute();

    echo "<script>
        alert('Update berhasil');
        location='admin.php?page=article';
    </script>";
}
?>

<div class="container">
    <h4 class="mb-3">Edit Article</h4>

    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="gambar_lama" value="<?= $data['gambar'] ?>">

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="<?= $data['judul'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Isi</label>
            <textarea name="isi" class="form-control" rows="6" required><?= $data['isi'] ?></textarea>
        </div>

        <div class="mb-3">
            <label>Gambar</label><br>
            <?php if ($data['gambar'] != '') { ?>
                <img src="img/<?= $data['gambar'] ?>" width="150" class="mb-2"><br>
            <?php } ?>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" name="update" class="btn btn-primary">
            Update
        </button>
        <a href="admin.php?page=article" class="btn btn-secondary">
            Batal
        </a>
    </form>
</div>
