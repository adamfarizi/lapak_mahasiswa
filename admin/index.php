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
        <h1 class="textatas">DATA BARANG</h1>
        <form action="../inputbarang/inputbarang.php" style="text-align: center;">
            <button style="cursor: pointer;" class="button"><bold>+</bold> Tambah Barang</button>
        </form><br>
        <table class="table table-striped table-bordered" id="data" style="margin-bottom: 10%;border-color:#28382b; background-color:#faf9ed;font-family:'Gladiora';">
            <thead>
                <center>
                <tr>
                    <th>ID BARANG</th>
                    <th>NAMA</th>
                    <th>JENIS</th>
                    <th>STOK</th>
                    <th>DESKRIPSI</th>
                    <th>FOTO</th>
                    <th>EDIT</th>
                    <th>HAPUS</th>
                </tr>
                </center>
            </thead>
            <tbody>
                <?php
                $no=0;
                $result=mysqli_query($koneksi, "SELECT * FROM barang WHERE ID_LAPAK = '$_SESSION[ID_LAPAK]'");
                while($row=mysqli_fetch_array($result)) {
                    $no++
                ?>
                    <tr>
                        <td><center><?php echo $row['ID_BARANG'];?></center></td>
                        <td><center><?php echo $row['NAMA_BARANG'];?></center></td>
                        <td><center><?php echo $row['JENIS_BARANG'];?></center></td>
                        <td><center><?php echo $row['STOK_BARANG'];?></center></td>
                        <td><center><?php echo $row['DESKRIPSI_BARANG'];?></center></td>
                        <td>
                            <c  enter>
                                <img src="../inputbarang/imagebarang/<?php echo $row['FOTO_BARANG']; ?>" 
                                 width="70px" height="100%"/>
                            </center>
                        </td>
                        <td><center><button type="button" style="cursor: pointer;" onclick="window.location.href='../inputbarang/edithapus/editbarang.php?edit=<?php echo $row['ID_BARANG'];?>'" class="button1">Edit</button></center></td>
                        <td><center><button type="button" style="cursor: pointer;" onclick="window.location.href='../inputbarang/edithapus/hapusbarang.php?hapus=<?php echo $row['ID_BARANG'];?>'"class="button2">Hapus</button></center></td> 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
            <script>
                $(document).ready(function(){
                    $('#data').DataTable();
                } );
            </script>
        </div>
        
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