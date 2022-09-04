<?php 
    session_start();
    include '../koneksi.php';

    if (isset($_COOKIE['EMAIL_PENJUAL']) && isset($_COOKIE['pass'])){
        $EMAIL_PENJUAL = $_COOKIE['EMAIL_PENJUAL'];
        $pass = $_COOKIE['pass'];

        $sql = mysqli_query($koneksi, "SELECT ID_LAPAK FROM penjual WHERE EMAIL_PENJUAL = $EMAIL_PENJUAL");
        $row = mysqli_fetch_assoc($sql);

            if ($key = $row['PASSWORD_PENJUAL']) { 
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
        <title>Login Penjual | LAPAK MAHASISWA</title>
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
            <h2>Log in Penjual</h2>
            <form action="" method="POST">
                    <input type="text" name="ID_LAPAK" placeholder="ID Penjual" required/><br>
                    <input type="password" name="PASSWORD_PENJUAL" placeholder="Password" required/><br>
                <div class="button">
                    <button type="submit" name="login" value="Masuk" /> Masuk </button>
                </div>
            </form>
            <center>
                <p>Belum punya akun? <a href="registerpenjual.php">Daftar di sini</a></p>
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
    <?php
    if (isset($_POST["login"])) {

    $ID_LAPAK = $_POST["ID_LAPAK"];
    $pass = mysqli_real_escape_string($koneksi,md5($_POST['PASSWORD_PENJUAL']));

    $sql = mysqli_query($koneksi,"SELECT * FROM penjual WHERE ID_LAPAK ='$ID_LAPAK'");
    $cek_akun = mysqli_num_rows($sql);
    $data_akun = mysqli_fetch_assoc($sql);
    $PASSWORD_PENJUAL = $data_akun['PASSWORD_PENJUAL'];

        if ($cek_akun>0) {
            if ($pass == $PASSWORD_PENJUAL) {
                $_SESSION['ID_LAPAK']=$ID_LAPAK;
                $_SESSION['EMAIL_PENJUAL']=$data_akun['EMAIL_PENJUAL'];
                
                if (isset($_POST["remember"])) {
                    setcookie('EMAIL_PENJUAL', $data_akun['EMAIL_PENJUAL'], time() + 60);
                    setcookie('nama', $data_akun['nama'], time() + 60);
                    setcookie('pass', $data_akun['PASSWORD_PENJUAL'], time() + 60);
                }
                header('Location:index.php');
            }else{
            echo"<script>
                    alert('password Anda salah');
                </script>";
            }
        }
        $error= true;
    }
    ?> 
    </body>
</html>