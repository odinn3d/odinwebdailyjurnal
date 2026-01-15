<?php
// Cek session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "koneksi.php";

// Cek function upload
if (!function_exists('upload_foto')) {
    include "upload_foto.php";
}

// --- LOGIKA PENCARIAN (AJAX) ---
if (isset($_POST['search'])) {
    $keyword = $_POST['search'];
    
    // TAMPILKAN DATA DENGAN JOIN USER
    // Supaya nama "Oleh: ..." muncul benar
    $sql = "SELECT gallery.*, user.username 
            FROM gallery 
            LEFT JOIN user ON gallery.users_id = user.id 
            WHERE gallery.deskripsi LIKE '%$keyword%' 
            ORDER BY gallery.tanggal DESC";
            
    $result = $conn->query($sql);
    
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr class="text-white">
            <td><?= $no++ ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td>
                <?php if ($row['gambar'] != '' && file_exists('img/' . $row['gambar'])) : ?>
                    <img src="img/<?= $row['gambar'] ?>" width="100" class="rounded shadow border border-secondary">
                <?php endif; ?>
            </td>
            <td><?= $row['deskripsi'] ?></td>
            <td><?= $row['username'] ?></td> <td class="text-center">
                <a href="admin.php?page=gallery_edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-success rounded-circle">
                    <i class="bi bi-pencil"></i>
                </a>
                <form method="post" class="d-inline">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="gambar" value="<?= $row['gambar'] ?>">
                    <button type="submit" name="hapus" class="btn btn-sm btn-danger rounded-circle" onclick="return confirm('Yakin hapus data ini?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        <?php
    }
    exit; 
}

// --- LOGIKA SIMPAN (INSERT) ---
if (isset($_POST['simpan'])) {
    $deskripsi = $_POST['deskripsi']; 
    $gambar = '';
    
    // LOGIKA BARU: CARI ID BERDASARKAN USERNAME
    // Kita ambil username dari session yang pasti ada
    $username_login = $_SESSION['username'];
    
    // Kita tanya database, username ini ID-nya berapa?
    $query_user = $conn->prepare("SELECT id FROM user WHERE username = ?");
    $query_user->bind_param("s", $username_login);
    $query_user->execute();
    $result_user = $query_user->get_result()->fetch_assoc();
    
    // Ambil ID-nya (Kalau admin nanti dapatnya 0)
    $users_id = $result_user['id']; 

    if ($_FILES['gambar']['name'] != '') {
        $upload = upload_foto($_FILES['gambar']);
        if ($upload['status']) {
            $gambar = $upload['message'];
        } else {
            echo "<script>alert('" . $upload['message'] . "'); location='admin.php?page=gallery';</script>";
            exit;
        }
    }

    $stmt = $conn->prepare("INSERT INTO gallery (deskripsi, gambar, tanggal, users_id) VALUES (?, ?, NOW(), ?)");
    $stmt->bind_param("ssi", $deskripsi, $gambar, $users_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Simpan data sukses'); location='admin.php?page=gallery';</script>";
    } else {
        echo "<script>alert('Simpan data gagal: " . $stmt->error . "'); location='admin.php?page=gallery';</script>";
    }
    $stmt->close();
}

// --- LOGIKA HAPUS ---
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '' && file_exists("img/" . $gambar)) {
        unlink("img/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Hapus data sukses'); location='admin.php?page=gallery';</script>";
    } else {
        echo "<script>alert('Hapus data gagal'); location='admin.php?page=gallery';</script>";
    }
    $stmt->close();
}
?>

<div class="container text-white">
    <div class="row mb-2">
        <div class="col-md-6">
            <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg"></i> Tambah Galeri
            </button>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Cari Deskripsi Galeri...">
                <span class="input-group-text bg-secondary text-white"><i class="bi bi-search"></i></span>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered table-dark"> 
            <thead class="table-secondary text-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="result">
                <tr><td colspan="6" class="text-center">Loading data...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-white" style="background-color: #1e1e1e; border: 1px solid #6f42c1;">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">Tambah Galeri</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Pilih Gambar</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    function loadData(key = "") {
        $.post("gallery.php", { search: key }, function(data) {
            $("#result").html(data);
        });
    }
    loadData();
    $("#search").on("keyup", function() {
        var key = $(this).val();
        loadData(key);
    });
});
</script>