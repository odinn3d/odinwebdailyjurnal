<?php
include "koneksi.php";

$judul = $_POST['judul'];
$nama = $_FILES['gambar']['name'];
$tmp  = $_FILES['gambar']['tmp_name'];

move_uploaded_file($tmp, "upload/".$nama);

$conn->query("INSERT INTO gallery (judul, gambar) VALUES ('$judul','$nama')");

header("Location: admin.php?page=gallery");
