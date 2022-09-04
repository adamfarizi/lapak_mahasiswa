<?php
    
    error_reporting(0);
    include '../koneksi.php';

?>
<!DOCTYPE html>
<html>
    <head>

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

        <title>Admin-LAPAK MAHASISWA</title>
        <link rel="shortcut icon" href="../src/LOGO LM.png">
        <link rel="stylesheet" href="../css/keranjang.css">
    </head>
    <body style="font-family: 'Gladiora';background-color:#faf9ed;">
        <div class="container">
        <br>
        <h1 class="textatas">DATA BARANG</h1>
        <table class="table table-striped table-bordered" id="data" style="margin-bottom: 10%;border-color:#28382b; background-color:#faf9ed;font-family:'Gladiora';">
            <thead>
                <center>
                <tr>
                    <th>NAMA BARANG</th>
                    <th>TANGGAL KERANJANG</th>
                    <th>JENIS</th>
                    <th>STOK</th>
                    <th>PESAN</th>
                    <th>FOTO</th>
                    <th>HAPUS</th>
                </tr>
                </center>
            </thead>
            <tbody>
                <?php
                $no=0;
                $result=mysqli_query($koneksi, "SELECT * FROM keranjang INNER JOIN barang ON keranjang.ID_BARANG=barang.ID_BARANG WHERE EMAIL_PENGGUNA = '$_SESSION[EMAIL_PENGGUNA]'");
                while($row=mysqli_fetch_array($result)) {
                    $no++
                ?>

                    <tr>
                        <td><center><?php echo $row['NAMA_BARANG'];?></center></td>
                        <td><center><?php echo $row['TGL_KERANJANG'];?></center></td>
                        <td><center><?php echo $row['JENIS_BARANG'];?></center></td>
                        <td><center><?php echo $row['STOK_BARANG'];?></center></td>
                        <td><center><?php echo $row['PESAN_KERANJANG'];?></center></td>
                        <td>
                            <center>
                                <img src="../inputbarang/imagebarang/<?php echo $row['FOTO_BARANG']; ?>" 
                                 width="70px" height="100%"/>
                            </center>
                        </td>
                        <td><center><button type="button" style="cursor: pointer;" onclick="window.location.href='edithapus/hapuskeranjang.php?hapus=<?php echo $row['ID_BARANG'];?>'"class="button2">Hapus</button></center></td> 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <script>
            $(document).ready(function(){
                $('#data').DataTable();
            } );
        </script>
        <center>
        <div class="bottom">
            <br>
            <img src="../src/4.png" style="width: 180px;">
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
        $query = mysqli_query($koneksi,"SELECT * FROM pengguna WHERE EMAIL_PENGGUNA = '$_SESSION[EMAIL_PENGGUNA]'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <div class="containeratas">
            <img src="../src/4.png" class="icon" onclick="window.location.href='../home.php'">
        </div>
        <div class="dropdwn">
            <img src="../user/profil/<?php echo $row['FOTO_PENGGUNA']; ?>" alt="img" height="40px" class="dropdown img">
            <button class="dropbtn"> <?php echo $row['NAMADEPAN_PENGGUNA']; ?> </button>
            <div class="dropdown-content">
                <a href="" >Account</a>
                <a href="index.php">Keranjang</a>
                <a href="../admin/logoutpenjual.php" >Log Out</a>
            </div>
        </div>
    </body>
</html>