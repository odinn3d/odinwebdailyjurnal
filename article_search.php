<?php
include "koneksi.php";

$keyword = $_POST['keyword'] ?? '';

$sql = "SELECT * FROM article 
        WHERE judul LIKE ? 
           OR isi LIKE ? 
           OR tanggal LIKE ? 
           OR username LIKE ?
        ORDER BY tanggal DESC";

$stmt = $conn->prepare($sql);

$search = "%" . $keyword . "%";
$stmt->bind_param("ssss", $search, $search, $search, $search);
$stmt->execute();

$hasil = $stmt->get_result();

$no = 1;
while ($row = $hasil->fetch_assoc()) {
?>
<tr>
    <td><?= $no++ ?></td>

    <!-- DESKRIPSI -->
    <td>
        <strong><?= $row["judul"] ?></strong><br>
        <small class="text-muted">
            pada : <?= $row["tanggal"] ?><br>
            oleh : <?= $row["username"] ?>
        </small>
    </td>

    <!-- ISI -->
    <td><?= $row["isi"] ?></td>

    <!-- GAMBAR -->
    <td>
        <?php if ($row["gambar"] != '' && file_exists("img/" . $row["gambar"])) { ?>
            <img src="img/<?= $row["gambar"] ?>" width="100">
        <?php } ?>
    </td>

    <!-- AKSI -->
    <td class="text-center">

        <!-- EDIT -->
        <a href="admin.php?page=article_edit&id=<?= $row['id'] ?>"
           class="badge rounded-pill text-bg-success">
            <i class="bi bi-pencil"></i>
        </a>

        <!-- HAPUS -->
        <form method="post"
              action="admin.php?page=article"
              class="d-inline">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="hidden" name="gambar" value="<?= $row['gambar'] ?>">
            <button name="hapus"
                    class="badge rounded-pill text-bg-danger border-0"
                    onclick="return confirm('Hapus data?')">
                <i class="bi bi-x-circle"></i>
            </button>
        </form>

    </td>
</tr>
<?php
}

$stmt->close();
$conn->close();
?>
