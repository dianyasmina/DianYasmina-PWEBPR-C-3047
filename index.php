<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book - app</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" herf="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
</head>

<body>
    <div class="sidebar">
        <p>Hai, User X</p>
        <div>
            <button class="logout">Logout</button>
        </div>
    </div>
    <div class="table">
        <div class="table_header">
            <p>Inventaris Buku - Yasmina App</p>

        </div>
        <div class="create">
            <!-- <input placeholder="Judul Buku"> -->
            <input placeholder="udul Buku">
            <button class="add_new" onclick="Tambah()">+ Add New</button>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Gambar Buku</th>
                        <th>Judul Buku</th>
                        <th>No. HP</th>
                        <th>Pemilik</th>
                        <th>Kelola</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach (mysqli_query(mysqli_connect("localhost","root","","test"), "SELECT * FROM buku") as $data)
                    {
                        $i++;
                        $send = $data["ID"];
                        $judul = $data["JudulBuku"];
                        $path = $data["Cover"];
                        $telp = $data["NoHp"];
                        $penerbit = $data["Pemilik"];
                        echo "<tr>";
                        echo "    <td>$i</td>";
                        echo "    <td><img src='$path' alt=''></td>";
                        echo "    <td>$judul</td>";
                        echo "    <td>$telp</td>";
                        echo "    <td>$penerbit</td>";
                        echo "    <td>";
                        echo "        <button onclick='Edit(" .$send. ")'><i class='far fa-edit'></i></button>";
                        echo "        <button onclick='Del(" .$send. ")'><i class='fas fa-trash-alt'></i></button>";
                        echo "    </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function Edit(send){
            window.location.href = "Edit.php?kondisi=" + send;
        }
        function Del(send) {
            if(confirm("Apakah Anda yakin ingin menyimpan perubahan?")){
                window.location.href = "DELETE.php?ID=" + send;
            }
        }
        function Tambah(){
            window.location.href = "Tambah.php";
        }
    </script>
</body>

</html>

<!-- INI BELOM :(
Dashboard memiliki tombol logout
Dashboard memiliki sidebar akun -->