<?php
if(isset($_GET["ID"])){
    $ID = $_GET["ID"];
    $data = mysqli_query(mysqli_connect("localhost","root","","test"), "SELECT * FROM buku WHERE Id=$ID");
    $row = mysqli_fetch_assoc($data);
    if (mysqli_query(mysqli_connect("localhost","root","","test"), "DELETE FROM buku WHERE Id = $ID")){
        // Periksa apakah file ada sebelum dihapus
        $file_path = $row['Cover'];
        if (file_exists($file_path)) {
            // Menghapus file
            if (unlink($file_path)) {
                echo "<script>alert('data berhasil Dihapus'); window.location='index.php';</script>";
            } else {
                echo "Gagal menghapus file.";
            }
        } else {
            echo "File tidak ditemukan.";
        }
    }
}
?>
