<?php
// Pastikan form telah dikirimkan
if (isset($_POST["submit"])) {
    // Koneksi ke database
    $koneksi = mysqli_connect("localhost", "root", "", "test");

    // Periksa koneksi
    if (mysqli_connect_errno()) {
        echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
        exit();
    }

    // Tangkap data dari form
    $judul = $_POST["judul"];
    $no_hp = $_POST["no_hp"];
    $pemilik = $_POST["pemilik"];

    // Tangkap file yang diunggah
    $file_name = $_FILES["cover"]["name"];
    $file_tmp = $_FILES["cover"]["tmp_name"];
    $file_error = $_FILES["cover"]["error"];


    // Cek apakah file JPG
    // $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    // if ($file_ext != "jpg") {
    //     echo "File yang diunggah harus berupa file JPG.";
    //     exit();
    // }

    // Ubah nama file sesuai dengan judul
    $file_new_name = $judul . ".jpg";

    // Tentukan lokasi penyimpanan file
    $file_destination = "Cover/" . $file_new_name;

    // Pindahkan file yang diunggah ke folder "Cover"
    if (move_uploaded_file($file_tmp, $file_destination)) {
        // Query untuk menyimpan data ke database
        $query = "INSERT INTO buku (JudulBuku, NoHP, Pemilik, Cover) VALUES ('$judul', '$no_hp', '$pemilik', '$file_destination')";
        
        // Eksekusi query
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Data berhasil disimpan'); window.location='index.php';</script>";
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal mengunggah file.";
    }

    // Tutup koneksi
    mysqli_close($koneksi);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Tambah Data</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fce4ec; /* Warna background pink */
    }
    .container {
        max-width: 400px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
    }
    .form-group input[type="text"],
    .form-group input[type="file"] {
        width: 97%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .btn {
        background-color: #ff4081; /* Warna pink */
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    .btn:hover {
        background-color: #d81b60; /* Warna pink lebih gelap saat hover */
    }
</style>
</head>
<body>

<div class="container">
    <h2 style="text-align:center;">Tambah Data</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="judul">Judul Buku:</label>
            <input type="text" id="judul" name="judul" required>
        </div>
        <div class="form-group">
            <label for="no_hp">No HP:</label>
            <input type="text" id="no_hp" name="no_hp" required>
        </div>
        <div class="form-group">
            <label for="pemilik">Pemilik:</label>
            <input type="text" id="pemilik" name="pemilik" required>
        </div>
        <div class="form-group">
            <label for="cover">Unggah Cover (JPG only):</label>
            <input type="file" id="cover" name="cover" accept="jpg" required>
        </div>
        <center><button type="submit" class="btn" name="submit">Simpan Data</button></center>
    </form>
</div>

</body>
</html>
