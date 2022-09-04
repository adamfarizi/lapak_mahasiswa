<?php 
    session_start();
    include '../koneksi.php';

    if (isset($_COOKIE['EMAIL_PENGGUNA']) && isset($_COOKIE['pass'])){
        $EMAIL_PENGGUNA = $_COOKIE['EMAIL_PENGGUNA'];
        $pass = $_COOKIE['pass'];

        $sql = mysqli_query($koneksi, "SELECT USERNAME_PENGGUNA FROM pengguna WHERE EMAIL_PENGGUNA = $EMAIL_PENGGUNA");
        $row = mysqli_fetch_assoc($sql);

            if ($key = $row['PASSWORD_PENGGUNA']) { 
                $_SESSION['login'] = true;
            }
    }

    if (isset($_SESSION["login"])) {
        header("Location: index.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Pengguna | LAPAK MAHASISWA</title>
        <link rel="shortcut icon" href="../src/LOGO LM.png">
        <link rel="stylesheet" href="../css/login.css">

    </head>
    <body>
        <div class="atas">
            <img src="../src/5.png" alt="logoatas" >
            <a href="../public/homepublic.php"> Kembali </a>
        </div>
        
        <div class="image">
            <img src="../src/LAPAK.png" alt="">
        </div>

        <div class="login">
            <h2>Log in Pengguna</h2>
            <form action="" method="POST">
                    <input type="text" name="USERNAME_PENGGUNA" placeholder="Username atau email" required/><br>
                    <input type="password" name="PASSWORD_PENGGUNA" placeholder="Password" required/><br>
                <div class="button">
                    <button type="submit" name="login" value="Masuk" /> Masuk </button>
                </div>
            </form>
            <center>
                <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            </center>    
        </div>

        <center>
        <div class="bottom">
            <br>
            <img src="../src/5.png" style="width: 180px;">
            <p class="botom1">
				<a href="#">Home</a>
				<a href="#">About</a>
                <a href="#">Instagram</a>
				<a href="#">Contact</a>
			</p>
            <footer class="footer">
                <br>
                Copyright &copy; 2022 All rights reserved | <strong>Lapak Mahasiswa</strong> by <strong> TI UNS PSDKU</strong>
            </footer>
        </div>
        </center>
            setcookie('pass', $data_akun['PASSWORD_PENGGUNA'], time() + 60);
                }
                header('Location:../home.php');
            }else{
            echo"<script>
                    alert('password Anda salah');
                </script>";
            }<?php
    if (isset($_POST["login"])) {

    $USERNAME_PENGGUNA = $_POST["USERNAME_PENGGUNA"];
    $pass = mysqli_real_escape_string($koneksi,md5($_POST['PASSWORD_PENGGUNA']));

    $sql = mysqli_query($koneksi,"SELECT * FROM pengguna WHERE USERNAME_PENGGUNA ='$USERNAME_PENGGUNA'");
    $cek_akun = mysqli_num_rows($sql);
    $data_akun = mysqli_fetch_assoc($sql);
    $PASSWORD_PENGGUNA = $data_akun['PASSWORD_PENGGUNA'];

        if ($cek_akun>0) {
            if ($pass == $PASSWORD_PENGGUNA) {
                $_SESSION['USERNAME_PENGGUNA']=$USERNAME_PENGGUNA;
                $_SESSION['EMAIL_PENGGUNA']=$data_akun['EMAIL_PENGGUNA'];
                
                if (isset($_POST["remember"])) {
                    setcookie('EMAIL_PENGGUNA', $data_akun['EMAIL_PENGGUNA'], time() + 60);
                    setcookie('nama', $data_akun['nama'], time() + 60);
                 
        }
        $error= true;
    }
    ?> 
    </body>
</html>