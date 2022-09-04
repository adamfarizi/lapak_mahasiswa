<?php 
include '../koneksi.php';
    if(isset($_POST['register'])){
        $ID_LAPAK =$_POST['ID_LAPAK'];
        $email = $_POST['EMAIL_PENJUAL'];
        $nama = $_POST['NAMA_PENJUAL'];
        $password = $_POST['PASSWORD_PENJUAL'];
        $confirmpassword = $_POST['confirmpassword'];
        $alamat = $_POST['ALAMAT_PENGGUNA'];
        $nowa = $_POST['NO_HP_PENJUAL'];
        $foto = $_FILES["FOTO_PENJUAL"]["name"];
        $tmp = $_FILES["FOTO_PENJUAL"]["tmp_name"];
        $path = "profil/";

        $query = mysqli_query($koneksi,"SELECT EMAIL_PENJUAL FROM penjual WHERE EMAIL_PENJUAL = '$email'");
        if (mysqli_fetch_assoc($query)) {
            echo"<script>
                    alert('Akun sudah terdaftar');
                </script>";
            echo "<script>location='login.php'</script>";
        }else{
            if ($password == $confirmpassword) {
                move_uploaded_file($tmp, $path.$foto);
                $password = md5($password);
                $query=mysqli_query($koneksi,"INSERT INTO penjual VALUES ('".$ID_LAPAK."','".$email."','".$password."','".$nama."','".$nowa."','".$alamat."','".$foto."')");
                    if($query){
                    echo"<script>
                        alert('Registrasi berhasil');
                    </script>";
                    echo "<script>location='loginpenjual.php'</script>";
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
        <title>Register Penjual | LAPAK MAHASISWA</title>
        <link rel="shortcut icon" href="../src/LOGO LM.png">
        <link rel="stylesheet" href="../css/register.css">

        <?php
            include '../koneksi.php';
            // mengambil data barang dengan kode paling besar
            $query = mysqli_query($koneksi, "SELECT max(ID_LAPAK) as kodeTerbesar FROM penjual");
            $data = mysqli_fetch_array($query);
            $ID_LAPAK = $data['kodeTerbesar'];

            // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
            // dan diubah ke integer dengan (int)
            $urutan = (int) substr($ID_LAPAK, 3, 3);
                
            // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
            $urutan++;
                
            // membentuk kode barang baru
            // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
            // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
            // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
            $angka = "PNJ";
            $ID_LAPAK = $angka . sprintf("%03s", $urutan);

        ?>

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
            <h2>Registrasi Penjual</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="NAMA_PENJUAL">Nama Penjual / Nama Toko*</label>
                <input type="text" name="NAMA_PENJUAL" required/>

                <label for="ID_PENJUAL">Id Lapak* (otomatis muncul)</label>
                <input type="text" name="ID_LAPAK" value="<?php echo $ID_LAPAK?>" readonly/>

                <label for="EMAIL_PENJUAL">Email*</label>
                <input type="email" name="EMAIL_PENJUAL" required/>

                <label for="PASSWORD_PENJUAL">Password*</label>
                <input type="password" name="PASSWORD_PENJUAL" required/>

                <label for="confirmpassword">Konfirmasi Password*</label>
                <input type="password" name="confirmpassword" required/>

                <label for="ALAMAT_PENGGUNA">Alamat*</label>
                <input type="text" name="ALAMAT_PENGGUNA" required/>

                <label for="NO_HP_PENJUAL">Nomor WA*</label>
                <input type="text" name="NO_HP_PENJUAL" required/>

                <label for="FOTO_PENJUAL">Foto Profil*</label>
                <input type="file" name="FOTO_PENJUAL" style="font-size: 15px;" required/>


                <div class="button">
                    <button type="submit" name="register" value="Daftar" /> Daftar </button>
                </div>
            </form>
            <center>
                <p>Sudah punya akun? <a href="loginpenjual.php">Log In</a></p>
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