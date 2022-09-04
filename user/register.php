<?php 
include '../koneksi.php';
    if(isset($_POST['register'])){
        $email = $_POST['EMAIL_PENGGUNA'];
        $username = $_POST['USERNAME_PENGGUNA'];
        $password = $_POST['PASSWORD_PENGGUNA'];
        $confirmpassword = $_POST['confirmpassword'];
        $alamat = $_POST['ALAMAT_PENGGUNA'];
        $namad = $_POST['NAMADEPAN_PENGGUNA'];
        $namab = $_POST['NAMABELAKANG_PENGGUNA'];
        $nowa = $_POST['NO_HP_PENGGUNA'];
        $foto = $_FILES["FOTO_PENGGUNA"]["name"];
        $tmp = $_FILES["FOTO_PENGGUNA"]["tmp_name"];
        $path = "profil/";

        $query = mysqli_query($koneksi,"SELECT EMAIL_PENGGUNA FROM pengguna WHERE EMAIL_PENGGUNA = '$email'");
        if (mysqli_fetch_assoc($query)) {
            echo"<script>
                    alert('Akun sudah terdaftar');
                </script>";
            echo "<script>location='login.php'</script>";
        }else{
            if ($password == $confirmpassword) {
                move_uploaded_file($tmp, $path.$foto);
                $password = md5($password);
                $query=mysqli_query($koneksi,"INSERT INTO pengguna VALUES ('".$email."','".$username."','".$password."','".$alamat."','".$namad."','".$namab."','".$nowa."','".$foto."')");
                    if($query){
                    echo"<script>
                        alert('Registrasi berhasil');
                    </script>";
                    echo "<script>location='login.php'</script>";
                }else{
                    echo"<script>
                            alert('Registrasi gagal');
                        </script>";
                }
            }else{
                echo"<script>
                        alert('Konfirmasi password tidak sesuai');
                    </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register Pengguna | LAPAK MAHASISWA</title>
        <link rel="shortcut icon" href="../src/LOGO LM.png">
        <link rel="stylesheet" href="../css/register.css">

    </head>
    <body>
        <div class="atas">
            <img src="../src/5.png" alt="logoatas" >   
            <a href="../public/homepublic.php"> Kembali </a>
        </div>

        <div class="image">
            <img src="../src/LAPAK.png" alt="">
        </div>

        <div class="register">
            <h2>Registrasi Pengguna</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="NAMADEPAN_PENGGUNA">Nama Depan*</label>
                <input type="text" name="NAMADEPAN_PENGGUNA" required/>

                <label for="NAMABELAKANG_PENGGUNA">Nama Belakang*</label>
                <input type="text" name="NAMABELAKANG_PENGGUNA" required/>

                <label for="USERNAME_PENGGUNA">Username*</label>
                <input type="text" name="USERNAME_PENGGUNA" required/>

                <label for="EMAIL_PENGGUNA">Email*</label>
                <input type="email" name="EMAIL_PENGGUNA" required/>

                <label for="PASSWORD_PENGGUNA">Password*</label>
                <input type="password" name="PASSWORD_PENGGUNA" required/>

                <label for="confirmpassword">Konfirmasi Password*</label>
                <input type="password" name="confirmpassword" required/>

                <label for="ALAMAT_PENGGUNA">Alamat*</label>
                <input type="text" name="ALAMAT_PENGGUNA" required/>

                <label for="NO_HP_PENGGUNA">Nomor WA*</label>
                <input type="text" name="NO_HP_PENGGUNA" required/>

                <label for="FOTO_PENGGUNA">Foto Profil*</label>
                <input type="file" name="FOTO_PENGGUNA" style="font-size: 15px;" required/>


                <div class="button">
                    <button type="submit" name="register" value="Daftar" /> Daftar </button>
                </div>
            </form>
            <center>
                <p>Sudah punya akun? <a href="login.php">Log In</a></p>
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
        
    </body>
</html>