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
        if(!isset($_SESSION['EMAIL_PENJUAL'])){
            echo"<script>
                    alert('Harap Login terlebih dahulu untuk menampilkan menu ini!');
                </script>";
                echo "<script>location='loginpenjual.php'</script>";
        }
        ?>

        <title>Admin-LAPAK MAHASISWA</title>
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
        <h1 class="textatas">TRANSAKSI TERKINI</h1>
        <table class="table table-striped table-bordered" id="data" style="border:1px solid black;">
            <thead>
                <center>
                <tr>
                    <th>NAMA PEMBELI</th>
                    <th>NAMA BARANG</th>
                    <th>TANGGAL TRANSAKSI</th>
                    <th>JENIS</th>
                    <th>HARGA</th>
                    <th>FOTO</th>
                    <th>STATUS</th>
                    <th>EDIT PERUBAHAN</th>
                    <th>HAPUS TRANSAKSI</th>
                </tr>
                </center>
            </thead>
            <tbody>
                <?php
                $no=0;
                $result=mysqli_query($koneksi, "SELECT * FROM keranjang INNER JOIN barang ON keranjang.ID_BARANG=barang.ID_BARANG INNER JOIN pembayaran ON keranjang.ID_KERANJANG=pembayaran.ID_KERANJANG INNER JOIN penjual ON penjual.ID_LAPAK=pembayaran.ID_LAPAK WHERE EMAIL_PENJUAL = '$_SESSION[EMAIL_PENJUAL]'");
                while($row=mysqli_fetch_array($result)) {
                    $STATUS_PEMBAYARAN = $row ['STATUS_PEMBAYARAN'];
                ?>

                    <tr>
                        <td><center><?php echo $row['NAMA_PEMBAYARAN'];?></center></td>
                        <td><center><?php echo $row['NAMA_BARANG'];?></center></td>
                        <td><center><?php echo $row['TGL_KERANJANG'];?></center></td>
                        <td><center><?php echo $row['JENIS_BARANG'];?></center></td>
                        <td><center><?php echo $row['JUMLAH_PEMBAYARAN'];?></center></td>
                        <td>
                            <center>
                                <img src="../transaksi/bukti/<?php echo $row['FOTO_PEMBAYARAN']; ?>" 
                                 width="70px" height="100%"/>
                            </center>
                        </td>
                        <form action="edithapus/prosesstatus.php" method="post">
                        <td><center>   
                            <select name="STATUS_PEMBAYARAN" id="STATUS_PEMBAYARAN">
                                <option name="STATUS_PEMBAYARAN" id="STATUS_PEMBAYARAN" value="BELUM DIKIRIM" <?php if ($STATUS_PEMBAYARAN == 'BELUM DIKIRIM') { echo 'selected'; }?>>Belum Dikirim</option>
                                <option name="STATUS_PEMBAYARAN" id="STATUS_PEMBAYARAN" value="SEDANG DIKIRIM" <?php if ($STATUS_PEMBAYARAN == 'SEDANG DIKIRIM') { echo 'selected'; }?>>Sedang Dikirim</option>
                                <option name="STATUS_PEMBAYARAN" id="STATUS_PEMBAYARAN" value="SUDAH DITERIMA" <?php if ($STATUS_PEMBAYARAN == 'SUDAH DITERIMA') { echo 'selected'; }?>>Sudah Diterima</option>
                            </select>
                        </center></td>
                        <td><center><input type="submit" name="edit" id="edit" value="Edit" class="button4" style="cursor: pointer;"></center></td>
                        </form>
                        <td><center><button type="button" style="cursor: pointer;" onclick="window.location.href='edithapus/hapustransaksi.php?hapus=<?php echo $row['ID_PEMBAYARAN'];?>'"class="button5">Hapus</button></center></td> 

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
        $query = mysqli_query($koneksi,"SELECT * FROM penjual WHERE EMAIL_PENJUAL = '$_SESSION[EMAIL_PENJUAL]'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <div class="containeratas">
            <img src="../src/4.png" class="icon" onclick="window.location.href='../home.php'">
        </div>
        <div class="dropdwn">
            <img src="profil/<?php echo $row['FOTO_PENJUAL']; ?>" alt="img" height="40px" class="dropdown img">
            <button class="dropbtn"> <?php echo $row['NAMA_PENJUAL']; ?> </button>
            <div class="dropdown-content">
                <a href="" >Account</a>
                <a href="index.php">Barang Anda</a>
                <a href="tabeltransaksi.php">Transaksi Terkini</a>
                <a href="../admin/logoutpenjual.php" >Log Out</a>
            </div>
        </div>
    </body>
</html>