<?php
    error_reporting(0);
    include '../koneksi.php';

    if (isset($_POST['bayar'])) {
        $ID_PEMBAYARAN=$_POST['ID_PEMBAYARAN'];
        $ID_LAPAK=$_POST['ID_LAPAK'];
        $ID_KERANJANG=$_POST['ID_KERANJANG'];
        $JUMLAH_PEMBAYARAN=$_POST['JUMLAH_PEMBAYARAN'];
        $ALAMAT_PEMBAYARAN=$_POST['ALAMAT_PEMBAYARAN'];
        $NAMA_PEMBAYARAN=$_POST['NAMA_PEMBAYARAN'];
        $FOTO_PEMBAYARAN=$_FILES['FOTO_PEMBAYARAN']['name'];
        $tmp=$_FILES['FOTO_PEMBAYARAN']['tmp_name'];
        $path="bukti/".$FOTO_PEMBAYARAN;

        if (move_uploaded_file($tmp, $path)) {
            $query = "INSERT INTO pembayaran (ID_PEMBAYARAN, ID_KERANJANG, ID_LAPAK, JUMLAH_PEMBAYARAN, ALAMAT_PEMBAYARAN, FOTO_PEMBAYARAN, NAMA_PEMBAYARAN) VALUES ('$ID_PEMBAYARAN' , '$ID_KERANJANG', '$ID_LAPAK', '$JUMLAH_PEMBAYARAN', '$ALAMAT_PEMBAYARAN', '$FOTO_PEMBAYARAN', '$NAMA_PEMBAYARAN')";
            $result = mysqli_query($koneksi, $query);
            if (!$result) {
                die ("Query gagal dijalankan: ". mysqli_errno($koneksi). " - ". mysqli_error($koneksi));
            }
            else {
                echo "<script>window.location.href='alertfinal.php'</script>";
            }
        }
    }
?>