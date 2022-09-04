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

        <title>LAPAK MAHASISWA</title>
        <link rel="shortcut icon" href="../src/LOGO LM.png">
        <link rel="stylesheet" href="../css/index.css">
        <link rel="stylesheet" href="../css/keranjang.css">
        <div class="table">
            <link rel="stylesheet" href="../DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css">
            <script src="../DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
            <script src="../DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
            <link rel="stylesheet" href="../bootstrap-4.1.3-dist/css/bootstrap.css">
            <link rel="stylesheet" href="../DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css">
        </div>
    </head>
    <body style="font-family: 'Gladiora';background-color:#faf9ed;">
        <div class="container">
        <br>
        <h1 class="textatas">TRANSAKSI ANDA</h1>
        <table class="table table-striped table-bordered" id="data" style="border:1px solid black;">
            <thead>
                <center>
                <tr>
                    <th>NAMA BARANG</th>
                    <th>TANGGAL TRANSAKSI</th>
                    <th>JENIS</th>
                    <th>FOTO</th>
                    <th>STATUS</th>
                </tr>
                </center>
            </thead>
            <tbody>
                <?php
                $no=0;
                $result=mysqli_query($koneksi, "SELECT * FROM keranjang INNER JOIN barang ON keranjang.ID_BARANG=barang.ID_BARANG INNER JOIN pembayaran ON keranjang.ID_KERANJANG=pembayaran.ID_KERANJANG WHERE EMAIL_PENGGUNA = '$_SESSION[EMAIL_PENGGUNA]'");
                while($row=mysqli_fetch_array($result)) {
                    $no++
                ?>

                    <tr>
                        <td><center><?php echo $row['NAMA_BARANG'];?></center></td>
                        <td><center><?php echo $row['TGL_KERANJANG'];?></center></td>
                        <td><center><?php echo $row['JENIS_BARANG'];?></center></td>
                        <td>
                            <center>
                                <img src="../inputbarang/imagebarang/<?php echo $row['FOTO_BARANG']; ?>" 
                                 width="70px" height="100%"/>
                            </center>
                        </td>
                        <td><center><?php echo $row['STATUS_PEMBAYARAN'];?></center></td>
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