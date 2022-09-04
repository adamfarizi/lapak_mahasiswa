<?php
    error_reporting(0);
    include '../koneksi.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>LAPAK MAHASISWA</title>
        <link rel="shortcut icon" href="../src/LOGO LM.png">
        <link rel="stylesheet" href="../css/menubarang.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <?php 
        session_start();
        $koneksi=mysqli_connect("localhost","root","","lapakmahasiswa");
        if(!isset($_SESSION['EMAIL_PENGGUNA'])){
            echo "<script>location='../alertpage.php'</script>";
        }
        ?>
    </head>
    <body>

        <div class="produk";">
            <div class="tampilanproduk" id="tampil">                
            <?php
            	if(isset($_GET['cari'])){
                    $cari = $_GET['cari'];
                    $result = mysqli_query($koneksi ,"select * from barang where NAMA_BARANG like '%".$cari."%'");				
                }else{
                    $result = mysqli_query($koneksi ,"select * from barang");		
                }
                while($row = mysqli_fetch_array($result)){
                    $ID_BARANG=$row['ID_BARANG'];
                    $ID_LAPAK=$row['ID_LAPAK'];
                    $HARGA_BARANG=$row['HARGA_BARANG'];
                    $JENIS_BARANG=$row['JENIS_BARANG'];
                    $STOK_BARANG=$row['STOK_BARANG'];
                    $DESKRIPSI_BARANG=$row['DESKRIPSI_BARANG'];
                    $FOTO_BARANG=$row['FOTO_BARANG'];
                    $NAMA_BARANG=$row['NAMA_BARANG'];
                ?>
                <div class="list-produk">
                    <img src="../inputbarang/imagebarang/<?php echo $row['FOTO_BARANG']; ?>">
        
                    <h4><?php echo $NAMA_BARANG ;?></h4>
                    <h5>Rp. <?php echo $HARGA_BARANG;?>,-</h5>
                    
                    <center>
                        <a class="tombol tombol-beli" href="../tampilanbarang/tampilanbarang.php?detail=<?=$row['ID_BARANG'];?>">Detail</a>
                    </center>
                </div>
                <?php } ?>
            </div>
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

        <div class="container">
            <img src="../src/4.png" class="icon" onclick="window.location.href='../home.php'">
            <form action="menubarang.php">
                <input type="text" name="cari" id="cari" placeholder="Cari Barang" style="padding: 0px 20px;width: 700px; height:40px;border-color:transparent ;border-radius:0.5em;">
                <button class="butoncari" id="caribarang" type="submit" value="Cari"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <?php
        $query = mysqli_query($koneksi,"SELECT * FROM pengguna WHERE EMAIL_PENGGUNA = '$_SESSION[EMAIL_PENGGUNA]'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <div class="dropdwn">
            <img src="../user/profil/<?php echo $row['FOTO_PENGGUNA']; ?>" alt="img" height="40px" class="dropdown img">
            <button class="dropbtn"> <?php echo $row['NAMADEPAN_PENGGUNA']; ?> </button>
            <div class="dropdown-content">
                <a href="" >Account</a>
                <a href="../keranjang/index.php">Keranjang</a>
                <a href="../user/logout.php" >Log Out</a>
            </div>
        </div>

    </body>
</html>