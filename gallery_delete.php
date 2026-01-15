<?php
include "koneksi.php";

$id = $_GET['id'];

$data = $conn->query("SELECT gambar FROM gallery WHERE id=$id")->fetch_assoc();
unlink("upload/".$data['gambar']);

$conn->query("DELETE FROM gallery WHERE id=$id");

header("Location: admin.php?page=gallery");
