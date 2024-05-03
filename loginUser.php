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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Periksa</title>
    <!--Judul Halaman-->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 300px;
            /* margin: 100px auto; */
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .register-link {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="proses_login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Masuk">
        </form>
        <div class="register-link">
            Belum punya akun? <a href="register.php">Register</a>
        </div>
    </div>

</body>
<!--akhir tempat untuk membuat konten-->

</html>