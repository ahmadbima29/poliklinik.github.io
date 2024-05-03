<?php
include_once ("koneksi.php");

if (isset($_POST['simpan'])) {
    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE nama SET 
                                        nama = '" . $_POST['nama'] . "',
                                        alamat = '" . $_POST['alamat'] . "',
                                        no_hp = '" . $_POST['no_hp'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO pasien(nama, alamat, no_hp) 
        VALUES ( 
            '" . $_POST['nama'] . "',
            '" . $_POST['alamat'] . "',
            '" . $_POST['no_hp'] . "'
            )");
    }

    echo "<script> 
            document.location='pasien.php';
            </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM pasien WHERE id = '" . $_GET['id'] . "'");
    }
    echo "<script> 
            document.location='pasien.php';
            </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">

    <!-- Bootstrap offline -->

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <!-- Bootstrap Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Pasien</title>
    <!--Judul Halaman-->
</head>

<body>
    <!--tempat untuk membuat konten-->
    <div class="container">
        <!--div berfungsi pemisah atau wadah untuk konten-->
        <h3>
            Pasien
        </h3>
        <hr>
        <!--Form Input Data-->

        <form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
            <!-- Kode php untuk menghubungkan form dengan database -->
            <?php
            $nama = '';
            $alamat = '';
            $no_hp = '';
            if (isset($_GET['id'])) {
                $ambil = mysqli_query(
                    $mysqli,
                    "SELECT * FROM pasien 
        WHERE id='" . $_GET['id'] . "'"
                );
                while ($row = mysqli_fetch_array($ambil)) {
                    $nama = $row['nama'];
                    $alamat = $row['alamat'];
                    $no_hp = $row['no_hp'];
                }
                ?>
                <input type="hidden" name="id" value="<?php echo
                    $_GET['id'] ?>">
                <?php
            }
            ?>
            <div class="col-md-12">
                <label for="inputNama" class="form-label fw-bold">
                    Nama
                </label>
                <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama Dokter"
                    value="<?php echo $nama ?>">
            </div>
            <div class="col-md-12">
                <label for="inputAlamat" class="form-label fw-bold">
                    Alamat
                </label>
                <input type="text" class="form-control" name="alamat" id="inputAlamat" placeholder="Alamat"
                    value="<?php echo $alamat ?>">
            </div>
            <div class="col-md-12">
                <label for="inputNoHp" class="form-label fw-bold">
                    No HP
                </label>
                <input type="text" class="form-control" name="no_hp" id="inputNoHp" placeholder="nomor handphone"
                    value="<?php echo $no_hp ?>">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
            </div>
        </form>
        <!-- Table-->
        <table class="table table-hover">
            <!--thead atau baris judul-->
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No HP</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <!--tbody berisi isi tabel sesuai dengan judul atau head-->
            <tbody>
                <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
        berdasarkan status dan tanggal awal-->
                <?php
                $result = mysqli_query(
                    $mysqli,
                    "SELECT * FROM pasien"
                );
                $no = 1;
                while ($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <th scope="row">
                            <?php echo $no++ ?>
                        </th>
                        <td>
                            <?php echo $data['nama'] ?>
                        </td>
                        <td>
                            <?php echo $data['alamat'] ?>
                        </td>
                        <td>
                            <?php echo $data['no_hp'] ?>
                        </td>
                        <td>
                            <a class="btn btn-info rounded-pill px-3" href="pasien.php?id=<?php echo $data['id'] ?>">Ubah
                            </a>
                            <a class="btn btn-danger rounded-pill px-3"
                                href="pasien.php?id=<?php echo $data['id'] ?>&aksi=hapus">Hapus
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
<!--akhir tempat untuk membuat konten-->

</html>