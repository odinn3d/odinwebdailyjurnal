<?php 
function upload_foto($File){    
    $uploadOk = 1;
    $hasil = array();
    $message = '';
 
    // Ambil properti file
    $FileName = $File['name'];
    $TmpLocation = $File['tmp_name'];
    $FileSize = $File['size'];

    // Ambil ekstensi file
    $FileExt = explode('.', $FileName);
    $FileExt = strtolower(end($FileExt));

    // Jenis file yang diperbolehkan
    $Allowed = array('jpg', 'png', 'gif', 'jpeg', 'webp');  // Saya tambah WEBP

    // Cek Ukuran File (UBAH DISINI)
    // 500000 = 500KB -> Kita ubah jadi 5000000 = 5MB
    if ($FileSize > 5000000) {
        $message .= "Maaf, ukuran file terlalu besar. Maksimal 5MB.";
        $uploadOk = 0;
    }

    // Cek Format File
    if(!in_array($FileExt, $Allowed)){
        $message .= "Maaf, hanya file JPG, JPEG, PNG, GIF & WEBP yang diperbolehkan.";
        $uploadOk = 0; 
    }

    // Cek apakah folder 'img' ada? Jika tidak, buat dulu.
    if (!file_exists('img')) {
        mkdir('img', 0777, true);
    }

    // Proses Upload
    if ($uploadOk == 0) {
        $hasil['status'] = false; 
    } else {
        // Nama file baru yang unik
        $NewName = date("YmdHis").uniqid().'.'.$FileExt;
        $UploadDestination = "img/". $NewName; 

        if (move_uploaded_file($TmpLocation, $UploadDestination)) {
            $message = $NewName; // Kirim nama file baru
            $hasil['status'] = true; 
        } else {
            $message .= "Maaf, terjadi error saat mengupload file. Cek permission folder.";
            $hasil['status'] = false; 
        }
    }
    
    $hasil['message'] = $message; 
    return $hasil;
}
?>