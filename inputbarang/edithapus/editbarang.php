<?php
    error_reporting(0);
    include '../../koneksi.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>LAPAK MAHASISWA</title>
        <link rel="shortcut icon" href="../../src/LOGO LM.png">
        <link rel="stylesheet" href="../../css/inputbarang1.css">

        <?php
            if (isset($_GET["edit"])) {
                $id = ($_GET["edit"]);

                $result = mysqli_query($koneksi, "SELECT * FROM barang WHERE ID_BARANG='$id'");
                while ($row = mysqli_fetch_array($result)) {
                    $ID_BARANG=$row['ID_BARANG'];
                    $ID_LAPAK=$row['ID_LAPAK'];
                    $HARGA_BARANG=$row['HARGA_BARANG'];
                    $JENIS_BARANG=$row['JENIS_BARANG'];
                    $STOK_BARANG=$row['STOK_BARANG'];
                    $DESKRIPSI_BARANG=$row['DESKRIPSI_BARANG'];
                    $FOTO_BARANG=$row['FOTO_BARANG'];
                    $NAMA_BARANG=$row['NAMA_BARANG'];
                }
            }
            else {
                echo "DATABASE BELUM NYAMBUNG";
            }
        
        ?>
    </head>
    <body>
        <?php
        $query = mysqli_query($koneksi,"SELECT * FROM penjual WHERE EMAIL_PENJUAL = '$_SESSION[EMAIL_PENJUAL]'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <div class="input">
            <img src="../../src/5.png" style="width:20%">
            <h2 style="text-align: center;">MASUKKAN BARANG ANDA</h2>
            <form action="proseseditbarang.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <label for="ID_BARANG"> ID BARANG : </label><br>    
                <input type="text" name="ID_BARANG" id="ID_BARANG" value="<?php echo $ID_BARANG?>" class="tampilanform" readonly><br>
                <label for="ID_LAPAK"> ID LAPAK : </label><br>    
                <input type="text" name="ID_LAPAK" id="ID_LAPAK" value="<?php echo $ID_LAPAK ?>" class="tampilanform" readonly><br>
                <label for="NAMA_BARANG"> NAMA BARANG : </label><br>
                <input type="text" name="NAMA_BARANG" id="NAMA_BARANG" value="<?php echo $NAMA_BARANG ?>" class="tampilanform" required><br>
                <label for="HARGA_BARANG"> HARGA BARANG : </label><br>
                <input type="number" name="HARGA_BARANG" id="HARGA_BARANG" value="<?php echo $HARGA_BARANG ?>" class="tampilanform"><br>
                <div>
                        <label for="JENIS_BARANG">JENIS BARANG : </label><br>
                        <input type="radio" name="JENIS_BARANG" id="JENIS_BARANG" value="Elektronik" <?php if ($JENIS_BARANG == 'Elektronik') echo 'checked';?> style="cursor:pointer;"> Elektronik <br>
                        <input type="radio" name="JENIS_BARANG" id="JENIS_BARANG" value="Buku" <?php if ($JENIS_BARANG == 'Buku') echo 'checked';?> style="cursor:pointer;"> Buku <br>
                        <input type="radio" name="JENIS_BARANG" id="JENIS_BARANG" value="Pakaian" <?php if ($JENIS_BARANG == 'Pakaian') echo 'checked';?> style="cursor:pointer;"> Pakaian <br>
                        <input type="radio" name="JENIS_BARANG" id="JENIS_BARANG" value="Lainnya" <?php if ($JENIS_BARANG == 'Lainnya') echo 'checked';?> style="cursor:pointer;"> Lainnya <br>
                </div><br>
                <label for="STOK_BARANG"> STOCK BARANG : </label><br>    
                <input type="number" name="STOK_BARANG" id="STOK_BARANG" value="<?php echo $STOK_BARANG ?>" class="tampilanform" required><br>
                <label for="DESKRIPSI_BARANG">DESKRIPSI BARANG :</label><br>
                <textarea name="DESKRIPSI_BARANG" id="DESKRIPSI_BARANG" cols="30" rows="10" class="tampilanformpanjang" required><?php echo $DESKRIPSI_BARANG ?></textarea>
                <label for="FOTO_BARANG">FOTO BARANG :</label>
                <input type="file" name="FOTO_BARANG" id="FOTO_BARANG"  style="margin-bottom: 5px; font-size: medium; color:#065776;"><br>
                <?php echo $FOTO_BARANG;?><br><br>
                <input type="checkbox" style="cursor:pointer; margin-bottom:5%;">SEMUA DATA SUDAH BENAR !<br>
                <input type="submit" name="edit" id="edit" value="Edit" class="button" style="cursor: pointer;"><br><br>
                <button onclick="window.location.href='../../admin/index.php'" class="button1" style="cursor: pointer;" >Keluar
                </div>
            </form>
        </div>
    </body>
</html>