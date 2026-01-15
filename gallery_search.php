<?php
include "koneksi.php";

$keyword = $_POST['keyword'];

$data = $conn->query("SELECT * FROM gallery 
                      WHERE judul LIKE '%$keyword%' 
                      ORDER BY tanggal DESC");

while ($row = $data->fetch_assoc()) {
    echo "<div>";
    echo "<b>".$row['judul']."</b><br>";
    echo "<img src='upload/".$row['gambar']."' width='150'><br>";
    echo "<small>".$row['tanggal']."</small>";
    echo "</div><hr>";
}
