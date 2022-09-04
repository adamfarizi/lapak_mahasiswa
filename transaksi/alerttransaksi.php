<?php
    
    error_reporting(0);
    include '../koneksi.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>LAPAK MAHASISWA</title>
        <link rel="shortcut icon" href="../src/LOGO LM.png">
        <style>
            @font-face {
                font-family: 'Gladiora'; 
                src: url('../src/gladiora-regular.ttf');
            }
            .container{
                position: absolute;
                top: 20%;
                width: 98%;
                overflow: hidden;
                font-family: 'Gladiora';
                font-size: 20px;
                color:white;
            }
            .button {
                background-color: rgb(0, 172, 57);
                font-family: 'Gladiora';
                border: none;
                color: white;
                font-size: medium;
                width: 20%;
                padding: 10px 0;
                border-radius: 1em;
                cursor: pointer;
            }
            div button:hover{
                background-color:rgb(3, 139, 48);
            }
            .button1{
                background-color: rgb(196, 24, 24);
            }
            .button1:hover{
                background-color: rgb(158, 20, 20);
            }
        </style>
        <?php 
        session_start();
        $koneksi=mysqli_connect("localhost","root","","lapakmahasiswa");
        if(!isset($_SESSION['EMAIL_PENGGUNA'])){
            echo"<script>
                    alert('Harap Login terlebih dahulu untuk menampilkan menu ini!');
                </script>";
                echo "<script>location='loginpenjual.php'</script>";
        }
        ?>
    </head>
    <body style="background-color: #0057BD;">
            <?php
                $no=0;
                $result=mysqli_query($koneksi, "SELECT * FROM keranjang INNER JOIN barang ON keranjang.ID_BARANG=barang.ID_BARANG WHERE EMAIL_PENGGUNA = '$_SESSION[EMAIL_PENGGUNA]'");
                while($row=mysqli_fetch_array($result)) {
                    $no++
            ?>
        <div class="container">
            <center><img src="../src/4.png" class="img" style="width: 200px;"></center> <br>
            <h1><center>APAKAH ANDA SUDAH KONFIRMASI METODE PEMBAYARAN KE PENJUAL ?</center></h1> <br>
            <center><button onclick="window.location.href='transaksi.php?transaksi=<?php echo $row['ID_KERANJANG'];?>'" class="button">Sudah</button></center><br>
            <center><button onclick="window.location.href='../keranjang/hapuskeranjang.php?hapus=<?php echo $row['ID_KERANJANG'];?>'" class="button button1">Belum</button></center>
        </div>
        <?php } ?>
    </body>
</html>