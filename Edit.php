<?php
if(isset($_GET['kondisi'])){
    $id = $_GET['kondisi'];
    $data = mysqli_query(mysqli_connect("localhost","root","","test"), "SELECT * FROM buku WHERE Id=$id");
    $row = mysqli_fetch_assoc($data);
    $judul = $row['JudulBuku'];
    $telp = $row['NoHP'];
    $pemilik = $row['Pemilik'];
}
else{
    header("Location: index.php");
    exit;
}
if(isset($_POST['submit'])){  
    $JUDUL = $_POST['judul'];
    $TELP = $_POST['no_hp'];
    $PEMILIK = $_POST['pemilik'];      
    if(mysqli_query(mysqli_connect("localhost","root","","test"), "UPDATE buku SET JudulBuku='$JUDUL', NoHP='$TELP', Pemilik='$PEMILIK' WHERE Id=$id")){
        echo "<script>alert('data berhasil diubah'); window.location='index.php';</script>";
    }else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Data</title>
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
    .container h2{
        text-align:center;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
    }
    .form-group input {
        width: 97%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .btn {
        background-color: #ff4081; /* Warna pink */
        width:180px;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-bottom:10px;
    }
    .btn:hover {
        background-color: #d81b60; /* Warna pink lebih gelap saat hover */
    }
   
</style>
</head>
<body>

<div class="container">
    <h2>Edit Data</h2>
    <form action="" method="post" onsubmit="return confirmSubmit()">
        <div class="form-group">
            <label for="judul">Judul Buku:</label>
            <input type="text" value="<?php echo $judul?>" id="judul" name="judul" required>
        </div>
        <div class="form-group">
            <label for="no_hp">No HP:</label>
            <input type="text" value="<?php echo $telp?>" id="no_hp" name="no_hp" required>
        </div>
        <div class="form-group">
            <label for="pemilik">Pemilik:</label>
            <input type="text" value="<?php echo $pemilik?>" id="pemilik" name="pemilik" required>
        </div>
            <center><button type="submit" class="btn" name="submit">Simpan Perubahan</button>
        </form>
        <button type="button" class="btn" onclick="cancel()">Cancel</button></center>
</div>
<script>
    function confirmSubmit() {
    // Konfirmasi kepada pengguna
        var result = confirm("Apakah Anda yakin ingin menyimpan perubahan?");

        // Kembalikan nilai true jika pengguna menekan OK, dan false jika pengguna menekan Batal
        return result;
    }
    function cancel(){
        window.location.href = "index.php"
    }

</script>
</body>
</html>
