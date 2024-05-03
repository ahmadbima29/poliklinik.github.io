<?php
include_once ("koneksi.php");

// Fungsi untuk melakukan hashing password
function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

// Jika form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Pengecekan apakah password dan konfirmasi password sama
    if ($password != $confirm_password) {
        echo "<script>alert('Password dan konfirmasi password tidak sama');</script>";
    } else {
        // Pengecekan apakah username sudah ada di database
        $check_query = "SELECT * FROM user WHERE username = '$username'";
        $check_result = mysqli_query($mysqli, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('Username sudah digunakan');</script>";
        } else {
            // Jika semua pengecekan berhasil, lakukan registrasi
            $hashed_password = hashPassword($password);
            $register_query = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";
            $register_result = mysqli_query($mysqli, $register_query);
            if ($register_result) {
                echo "<script>alert('Registrasi berhasil');</script>";
                // Redirect ke halaman login setelah registrasi berhasil
                header("Location: login.php");
                exit; // Pastikan untuk keluar dari script setelah melakukan redirect
            } else {
                echo "<script>alert('Registrasi gagal');</script>";
            }
        }
    }
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
            <input type="submit" value="Register">
        </form>
        <div class="login-link">
            Sudah punya akun? <a href="login.php">Login</a>
        </div>
    </div>
</body>
<!--akhir tempat untuk membuat konten-->

</html>