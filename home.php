<?php
    error_reporting(0);
    include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>LAPAK MAHASISWA</title>
        <link rel="shortcut icon" href="src/LOGO LM.png">
        <link rel="stylesheet" href="css/home1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php 
        session_start();
        $koneksi=mysqli_connect("localhost","root","","lapakmahasiswa");
        if(!isset($_SESSION['EMAIL_PENGGUNA'])){
            echo "<script>location='alertpage.php'</script>";
        }
        ?>
    </head>
    <body>
        
        <div class="atas">
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <img src="src/iklan1.png" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <img src="src/iklan2.png" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <img src="src/iklan3.png" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img src="src/iklan4.png" style="width:100%">
                </div>
                <div style="text-align:center; margin-top:-5%;">
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                    <span class="dot"></span>
                </div>
                <div class="bannerkanan">
                    <img src="src/LAPAK 2.png" style="width:100%;" class="bannerkanan1">
                    <img src="src/iklan5.png" style="width:100%;" class="bannerkanan2">
                </div>
            </div>
                <script>
                    let slideIndex = 0;
                    showSlides();

                    function showSlides() {
                    let i;
                    let slides = document.getElementsByClassName("mySlides");
                    let dots = document.getElementsByClassName("dot");
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";  
                    }
                    slideIndex++;
                    if (slideIndex > slides.length) {slideIndex = 1}    
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex-1].style.display = "block";  
                    dots[slideIndex-1].className += " active";
                    setTimeout(showSlides, 5000); // Change image every 2 seconds
                    }
                </script>
            <div class="menuicon">
                <div class="iconshop hovericon">
                    <center><img src="src/shopping-cart.png" style="width: 40px;" onclick="window.location.href='tampilanbarang/menubarang.php'"></center>
                </div>
                <div class="laundry hovericon">
                    <center><img src="src/laundry.png" style="width: 40px;" onclick="window.location.href='home.php'"></center>
                </div>
                <div class="food hovericon">
                    <center><img src="src/fast-food.png" style="width: 40px;" onclick="window.location.href='home.php'"></center>
                </div>
                <div class="more hovericon">
                    <center><img src="src/more.png" style="width: 40px;" onclick="window.location.href='home.php'"></center>
                </div>
            </div>
        </div>

        <div class="produk";">
            <div class="newproduk">
                <h2 style="color:#0057BD;">Produk Kami</h2>
            </div>
            <div class="tampilanproduk" id="tampil">
                <?php
                $result=mysqli_query($koneksi, "SELECT * FROM barang ORDER BY ID_BARANG ASC LIMIT 0,16");
                while($row=mysqli_fetch_array($result)) {
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
                    <img src="inputbarang/imagebarang/<?php echo $row['FOTO_BARANG']; ?>">
        
                    <h4><?php echo $NAMA_BARANG ;?></h4>
                    <h5>Rp. <?php echo $HARGA_BARANG;?>,-</h5>
                    
                    <center>
                        <a class="tombol tombol-beli" href="tampilanbarang/tampilanbarang.php?detail=<?=$row['ID_BARANG'];?>">Detail</a>
                    </center>
                </div>
                <?php } ?>
            </div>
        </div>

        <center>
        <div class="next">
            <button onclick="window.location.href='tampilanbarang/menubarang.php'">Next >></button>
        </div>
        </center>

        <div class="list">
            <div class="list-kiri">
                <ul>
                <a href="tampilanbarang/menubarang.php">Barang Bekas</a><br><br>
                    <li><a href="">Elektronik</a></li>
                    <li><a href="">Buku</a></li>
                    <li><a href="">Pakaian</a></li>
                    <li><a href="">Coming Soon</a></li>
                    <li><a href="">Coming Soon</a></li>
                    <li><a href="">Lainnya...</a></li>
                </ul>
            </div>
            <div class="list-tengah">
                <ul>
                <a href="">Laundry</a><br><br>
                    <li><a href="">Coming Soon</a></li>
                    <li><a href="">Coming Soon</a></li>
                    <li><a href="">Coming Soon</a></li>
                    <li><a href="">Coming Soon</a></li>
                    <li><a href="">Coming Soon</a></li>
                    <li><a href="">Lainnya...</a></li>
                </ul>
            </div>
            <div class="list-kanan">
                <ul>
                <a href="">Makanan</a><br><br>
                    <li><a href="">Coming Soon</a></li>
                    <li><a href="">Coming Soon</a></li>
                    <li><a href="">Coming Soon</a></li>
                    <li><a href="">Coming Soon</a></li>
                    <li><a href="">Coming Soon</a></li>
                    <li><a href="">Lainnya...</a></li>
                </ul>
            </div>
        </div>
        <center>
        <div class="bottom">
            <br>
            <img src="src/4.png" style="width: 180px;">
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
            <img src="src/4.png" class="icon" onclick="window.location.href='home.php'">
            <form action="tampilanbarang/menubarang.php">
                <input type="text" name="cari" id="cari" placeholder="Cari Barang" style="padding: 0px 20px;width: 700px; height:40px;border-color:transparent ;border-radius:0.5em;">
                <button class="butoncari" id="caribarang" type="submit" value="Cari"><i class="fa fa-search"></i></button>
            </form>
        </div>
        
        <?php
        $query = mysqli_query($koneksi,"SELECT * FROM pengguna WHERE EMAIL_PENGGUNA = '$_SESSION[EMAIL_PENGGUNA]'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <div class="dropdwn">
            <img src="user/profil/<?php echo $row['FOTO_PENGGUNA']; ?>" alt="img" height="40px" class="dropdown img">
            <button class="dropbtn"> <?php echo $row['NAMADEPAN_PENGGUNA']; ?> </button>
            <div class="dropdown-content">
                <a href="" >Account</a>
                <a href="keranjang/index.php">Keranjang</a>
                <a href="user/logout.php" >Log Out</a>
            </div>
        </div>
    </body>
</html>