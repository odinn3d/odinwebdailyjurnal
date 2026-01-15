<?php
// Cek session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "koneksi.php";
include "upload_foto.php";

// Ambil ID dari URL
$id = $_GET['id'] ?? 0;

// Ambil data
$stmt = $conn->prepare("SELECT * FROM gallery WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    echo "<script>alert('Data tidak ditemukan');location='admin.php?page=gallery'</script>";
    exit;
}

// PROSES UPDATE
if (isset($_POST['update'])) {
    $deskripsi = $_POST['deskripsi']; 
    $gambar = $data['gambar'];

    if ($_FILES['gambar']['name'] != '') {
        $upload = upload_foto($_FILES['gambar']);
        
        if ($upload['status']) {
            if (file_exists("img/" . $data['gambar'])) {
                unlink("img/" . $data['gambar']);
            }
            $gambar = $upload['message'];
        } else {
            echo "<script>alert('{$upload['message']}')</script>";
            exit;
        }
    }

    // FIX: Update ke kolom 'deskripsi'
    $stmt = $conn->prepare("UPDATE gallery SET deskripsi=?, gambar=? WHERE id=?");
    $stmt->bind_param("ssi", $deskripsi, $gambar, $id);
    $stmt->execute();

    echo "<script>alert('Data berhasil diperbarui!'); location='admin.php?page=gallery'</script>";
}
?>

<div class="container text-white">
    <h4 class="mb-3">Edit Gallery</h4>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <input type="text" name="deskripsi" 
                   class="form-control" 
                   value="<?= $data['deskripsi'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar</label><br>
            <img src="img/<?= $data['gambar'] ?>" width="150" class="mb-3 rounded shadow border border-secondary">
            <input type="file" name="gambar" class="form-control">
        </div>

        <div class="mb-3">
            <button name="update" class="btn btn-primary">Update</button>
            <a href="admin.php?page=gallery" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>