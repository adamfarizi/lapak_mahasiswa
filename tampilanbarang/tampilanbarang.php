<!DOCTYPE html>
<html>
    <head>
        <title>LAPAK MAHASISWA</title>
        <link rel="shortcut icon" href="../src/LOGO LM.png">
        <link rel="stylesheet" href="../css/tampilanbarang.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <?php 
        session_start();
        $koneksi=mysqli_connect("localhost","root","","lapakmahasiswa");
        if(!isset($_SESSION['EMAIL_PENGGUNA'])){
            echo "<script>location='../alertpage.php'</script>";
        }
        ?>
    </head>
    <body>
    <?php
    error_reporting(0);
    include '../koneksi.php';

    if (isset($_GET["detail"])) {
        $id = ($_GET["detail"]);

        $result = mysqli_query($koneksi, "SELECT * FROM barang INNER JOIN penjual ON barang.ID_LAPAK=penjual.ID_LAPAK WHERE ID_BARANG='$id'");
        while ($row = mysqli_fetch_array($result)) {
            $ID_BARANG=$row['ID_BARANG'];
            $ID_LAPAK=$row['ID_LAPAK'];
            $HARGA_BARANG=$row['HARGA_BARANG'];
            $JENIS_BARANG=$row['JENIS_BARANG'];
            $STOK_BARANG=$row['STOK_BARANG'];
            $DESKRIPSI_BARANG=$row['DESKRIPSI_BARANG'];
            $FOTO_BARANG=$row['FOTO_BARANG'];
            $NAMA_BARANG=$row['NAMA_BARANG'];

            $NAMA_PENJUAL=$row['NAMA_PENJUAL'];
            $NO_HP_PENJUAL=$row['NO_HP_PENJUAL'];

        }
    }
    else {
        echo "DATABASE BELUM NYAMBUNG";
    }

    ?>
        <div class="kiri">
            <img src="../inputbarang/imagebarang/<?php echo $FOTO_BARANG; ?>" alt="img" width="500px">
        </div>
        <div class="kananatas">
            <h1>RP.<?php echo $HARGA_BARANG; ?>,-</h1>
            <h3><?php echo $NAMA_BARANG; ?></h3>
            <button class="tombol tombol-beli" onclick="window.location.href='../keranjang/proseskeranjang.php?detail2=<?= $id ;?>'" >Beli</button>
            <a href="https://api.whatsapp.com/send/?phone=<?php echo $NO_HP_PENJUAL ?>&text=Hi,%20Admin.%0ASaya tertarik%20untuk%20membeli%20baranng%20anda.%0ABoleh%20tanya-tanya%20dulu?" class="tombol-pesan"> <img src="../src/whatsapp.png" alt="img-whtsp" width="15px"> Hubungi Penjual</a>
        </div>
        <div class="kananbawah">
            <h2>Deskripsi Barang</h2>
            <hr size="1px" color="black" width="80%">
            <div class="keterangan">
                <ul>
                    <ol><b>Nama : </b><?php echo $NAMA_BARANG; ?></ol>
                    <ol><b>Jenis : </b><?php echo $JENIS_BARANG; ?></ol>
                    <ol><b>Stok : </b><?php echo $STOK_BARANG; ?></ol>
                    <ol><b>Penjual : </b><?php echo $NAMA_PENJUAL; ?></ol>
                    <ol><b>Kondisi : </b><br> <?php echo $DESKRIPSI_BARANG; ?></ol>
                </ul>
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