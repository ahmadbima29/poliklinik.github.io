<?php
include_once ("koneksi.php");

if (isset($_POST['simpan'])) {
    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE periksa SET 
                                        id_pasien = '" . $_POST['nama'] . "',
                                        id_dokter = '" . $_POST['dokter'] . "',
                                        tgl_periksa = '" . $_POST['tgl_periksa'] . "',
                                        catatan = '" . $_POST['catatan'] . "',
                                        obat = '" . $_POST['obat'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO periksa (id_pasien, id_dokter, tgl_periksa, catatan, obat) 
                                    VALUES ( 
                                        '" . $_POST['nama'] . "',
                                        '" . $_POST['dokter'] . "',
                                        '" . $_POST['tgl_periksa'] . "',
                                        '" . $_POST['catatan'] . "',
                                        '" . $_POST['obat'] . "'
                                        )");
    }

    echo "<script> 
            document.location='periksa.php';
            </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM periksa WHERE id = '" . $_GET['id'] . "'");
    }
    echo "<script> 
            document.location='periksa.php';
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

    <title>Periksa</title>
    <!--Judul Halaman-->
</head>

<body>
    <!--tempat untuk membuat konten-->
    <div class="container">
        <!--div berfungsi pemisah atau wadah untuk konten-->
        <hr>
        <!--Form Input Data-->

        <form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
            <!-- Kode php untuk menghubungkan form dengan database -->
            <?php
            $nama = '';
            $dokter = '';
            $tgl_periksa = '';
            $catatan = '';
            $obat = '';
            if (isset($_GET['id'])) {
                $ambil = mysqli_query(
                    $mysqli,
                    "SELECT * FROM periksa 
        WHERE id='" . $_GET['id'] . "'"
                );
                while ($row = mysqli_fetch_array($ambil)) {
                    $nama = $row['nama'];
                    $dokter = $row['dokter'];
                    $tgl_periksa = $row['tgl_periksa'];
                    $catatan = $row['catatan'];
                    $obat = $row['obat'];
                }
                ?>
                <input type="hidden" name="id" value="<?php echo
                    $_GET['id'] ?>">
                <?php
            }
            ?>
            <div class="col-md-12">
                <label for="inputNama" class="form-label fw-bold">
                    Pasien
                </label>
                <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama"
                    value="<?php echo $nama ?>">
            </div>
            <div class="col-md-12">
                <label for="inputDokter" class="form-label fw-bold">
                    Dokter
                </label>
                <input type="text" class="form-control" name="dokter" id="inputDokter" placeholder="Nama Dokter"
                    value="<?php echo $dokter ?>">
            </div>
            <div class="col-md-12">
                <label for="inputTglPeriksa" class="form-label fw-bold">
                    Tanggal Periksa
                </label>
                <input type="datetime-local" class="form-control" name="tgl_periksa" id="tgl_periksa"
                    placeholder="Tanggal Periksa" value="<?php echo $tgl_periksa ?>">
            </div>
            <div class="col-md-12">
                <label for="inputCatatan" class="form-label fw-bold">
                    Catatan
                </label>
                <input type="text" class="form-control" name="catatan" id="inputCatatan" placeholder="Masukan Catatan"
                    value="<?php echo $catatan ?>">
            </div>
            <div class="col-md-12">
                <label for="inputObat" class="form-label fw-bold">
                    Obat
                </label>
                <input type="text" class="form-control" name="obat" id="inputObat" placeholder="Obat"
                    value="<?php echo $obat ?>">
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
                    <th scope="col">Dokter</th>
                    <th scope="col">Tanggal Periksa</th>
                    <th scope="col">Obat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <!--tbody berisi isi tabel sesuai dengan judul atau head-->
            <tbody>
                <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
        berdasarkan status dan tanggal awal-->
                <?php
                $result = mysqli_query($mysqli, "SELECT pr.*,d.nama as 'nama_dokter', p.nama as 'nama_pasien' FROM periksa pr LEFT JOIN dokter d ON (pr.id_dokter=d.id) LEFT JOIN pasien p ON (pr.id_pasien=p.id) ORDER BY pr.tgl_periksa DESC");
                $no = 1;
                while ($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $no++ ?>
                        </td>
                        <td>
                            <?php echo $data['nama_pasien'] ?>
                        </td>
                        <td>
                            <?php echo $data['nama_dokter'] ?>
                        </td>
                        <td>
                            <?php echo $data['tgl_periksa'] ?>
                        </td>
                        <td>
                            <?php echo $data['catatan'] ?>
                        </td>
                        <td>
                            <?php echo $data['obat'] ?>
                        </td>
                        <td>
                            <a class="btn btn-success rounded-pill px-3"
                                href="index.php?page=periksa&id=<?php echo $data['id'] ?>">
                                Ubah</a>
                            <a class="btn btn-danger rounded-pill px-3"
                                href="index.php?page=periksa&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
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