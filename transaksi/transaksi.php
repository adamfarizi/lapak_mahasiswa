<?php
    include '../koneksi.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>LAPAK MAHASISWA</title>
        <link rel="shortcut icon" href="../src/LOGO LM.png">
        <link rel="stylesheet" href="../css/transaksi.css">
        <?php
            include '../koneksi.php';
            // mengambil data barang dengan kode paling besar
            $query = mysqli_query($koneksi, "SELECT max(ID_PEMBAYARAN) as kodeTerbesar FROM pembayaran");
            $data = mysqli_fetch_array($query);
            $ID_PEMBAYARAN = $data['kodeTerbesar'];

            // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
            // dan diubah ke integer dengan (int)
            $urutan = (int) substr($ID_PEMBAYARAN, 3, 3);
                
            // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
            $urutan++;
                
            // membentuk kode barang baru
            // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
            // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
            // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
            $angka = "BYR";
            $ID_PEMBAYARAN = $angka . sprintf("%03s", $urutan);

        ?>

        <?php 
        session_start();
        $koneksi=mysqli_connect("localhost","root","","lapakmahasiswa");
        if(!isset($_SESSION['EMAIL_PENGGUNA'])){
            echo"<script>
                    alert('Harap Login terlebih dahulu untuk menampilkan menu ini!');
                </script>";
                echo "<script>location='../user/login.php'</script>";
        }
        ?>

        <?php
            if (isset($_GET["transaksi"])) {
                $id = ($_GET["transaksi"]);

                $result = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE ID_keranjang='$id'");
                while ($row = mysqli_fetch_assoc($query)) {
                   
                }
            }
            else {
                echo "DATABASE BELUM NYAMBUNG";
            }

        ?>
    </head>
    <body>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM keranjang INNER JOIN barang ON keranjang.ID_BARANG=barang.ID_BARANG INNER JOIN pengguna ON keranjang.EMAIL_PENGGUNA=keranjang.EMAIL_PENGGUNA INNER JOIN penjual ON barang.ID_LAPAK = penjual.ID_LAPAK WHERE keranjang.ID_KERANJANG = '$id'");
        $row = mysqli_fetch_assoc($query);
        $HARGA_BARANG = $row['HARGA_BARANG'];
        ?>

        <div class="input">
            <img src="../src/5.png" style="width:20%">
            <h2 style="text-align: center;">MASUKKAN DATA DIRI ANDA</h2>
            <h5 style="text-align: center;">SEBELUM MELAKUKAN PEMBAYARAN HARAP KONFIRMASI KEPADA PENJUAL TERLEBIH DAHULU !</h5>
            <form action="prosestransaksi.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <label for="NAMA_PEMBAYARAN"> NAMA : </label><br>
                <input type="text" name="NAMA_PEMBAYARAN" id="NAMA_PEMBAYARAN" value="<?php echo $row['NAMADEPAN_PENGGUNA'] ?> <?php echo $row['NAMABELAKANG_PENGGUNA'] ?>" class="tampilanform" readonly><br>

                <label for="ID_PEMBAYARAN"> ID PEMBAYARAN : </label><br>
                <input type="text" name="ID_PEMBAYARAN" id="ID_PEMBAYARAN" value="<?php echo $ID_PEMBAYARAN ?>" class="tampilanform hilang" readonly><br>

                <label for="ID_LAPAK"> ID LAPAK : </label><br>
                <input type="text" name="ID_LAPAK" id="ID_LAPAK" value="<?php echo $row['ID_LAPAK'] ?>" class="tampilanform hilang" readonly><br>

                <label for="ID_KERANJANG"> ID KERANJANG : </label><br>
                <input type="text" name="ID_KERANJANG" id="ID_KERANJANG" value="<?php echo $row['ID_KERANJANG'] ?>" class="tampilanform hilang" readonly><br>

                <label for="NAMA_PENJUAL"> NAMA PENJUAL : </label><br>
                <input type="text" name="NAMA_PENJUAL" id="NAMA_PENJUAL" value="<?php echo $row['NAMA_PENJUAL'] ?>" class="tampilanform" readonly><br>
                
                <label for="NAMA_BARANG"> NAMA BARANG : </label><br>
                <input type="text" name="NAMA_BARANG" id="NAMA_BARANG" value="<?php echo $row['NAMA_BARANG'] ?>" class="tampilanform" readonly><br>
                
                <label for="JENIS_BARANG"> JENIS BARANG : </label><br>
                <input type="text" name="JENIS_BARANG" id="JENIS_BARANG" value="<?php echo $row['JENIS_BARANG'] ?>" class="tampilanform" readonly><br>
                

                <label for="HARGA_BARANG"> HARGA BARANG : </label><br>
                <input type='text' name="HARGA_BARANG" id="HARGA_BARANG" value="<?php echo $row['HARGA_BARANG'] ?>" onkeyup="perkalian();" class="tampilanform" readonly><br>
                
                <label for="PESAN">JUMLAH PEMESANAN :</label><br>
                <input type='text' name="PESAN" id="PESAN" onkeyup="perkalian();" class="tampilanform"><br>

                <label for="JUMLAH_PEMBAYARAN">TOTAL HARGA :</label><br>
                <input type='text' name="JUMLAH_PEMBAYARAN" id="JUMLAH_PEMBAYARAN"  onkeyup="perkalian();" class="tampilanform" readonly><br>

                <label for="ALAMAT_PEMBAYARAN">ALAMAT_PEMBAYARAN :</label><br>
                <textarea type='textarea' name="ALAMAT_PEMBAYARAN" id="ALAMAT_PEMBAYARAN" cols="30" row="10" class="tampilanformpanjang"></textarea><br>
                
                <label for="FOTO_PEMBAYARAN">BUKTI PEMBAYARAN :</label>
                <input type="file" name="FOTO_PEMBAYARAN" id="FOTO_PEMBAYARAN" style="margin-bottom: 15px; font-size: medium; color:#065776;" required><br>
                
                <input type="checkbox" style="cursor:pointer; margin-bottom:5%;">SEMUA DATA SUDAH BENAR !<br>
                
                <input type="submit" name="bayar" id="bayar" value="BAYAR" class="button" style="cursor: pointer;"><br><br>
            </div>

                <script>
function perkalian() {
      var txtFirstNumberValue = document.getElementById('HARGA_BARANG').value;
      var txtSecondNumberValue = document.getElementById('PESAN').value;
      var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue)
      if (!isNaN(result)) {
         document.getElementById('JUMLAH_PEMBAYARAN').value = result;
      }
}
</script>
            </form>
        </div>
    </body>
</html>