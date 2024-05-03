<?php
include_once ("koneksi.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Sistem Informasi Poliklinik</title>
    <!--Judul Halaman-->
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistem Informasi Poliklinik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Dropdown</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="index.php?page=dokter">Dokter</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="index.php?page=pasien">Pasien</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=periksa">Periksa</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <!-- Tambahkan spasi agar Register dan Login berada jauh di kanan -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=registerUser">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=loginUser">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main role="main" class="container">
        <?php
        if (isset($_GET['page'])) {
            ?>
            <h2>
                <?php echo ucwords($_GET['page']) ?>
            </h2>
            <?php
            include ($_GET['page'] . ".php");
        } else {
            echo "Selamat Datang di Sistem Informasi Poliklinik";
        }
        ?>
    </main>

</body>

</html>