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
    <td>
        <strong><?= $row["judul"] ?></strong><br>
        pada : <?= $row["tanggal"] ?><br>
        oleh : <?= $row["username"] ?>
    </td>
    <td><?= $row["isi"] ?></td>
    <td>
        <?php
        if ($row["gambar"] != '') {
            if (file_exists("img/" . $row["gambar"])) {
                echo '<img src="img/' . $row["gambar"] . '" width="100">';
            }
        }
        ?>
    </td>
    <td>
        <a href="#" class="badge rounded-pill text-bg-success">
            <i class="bi bi-pencil"></i>
        </a>
        <a href="#" class="badge rounded-pill text-bg-danger">
            <i class="bi bi-x-circle"></i>
        </a>
    </td>
</tr>
<?php
}

$stmt->close();
$conn->close();
?>
