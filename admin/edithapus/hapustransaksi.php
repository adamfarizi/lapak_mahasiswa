<?php
    error_reporting(0);
    include ('../../koneksi.php');

    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];

        $file = mysqli_query($koneksi, "SELECT FOTO_PEMBAYARAN FROM pembayaran where ID_PEMBAYARAN='$id'");
        $hasil = mysqli_fetch_array($file);
        $foto_lama=$hasil['FOTO_PEMBAYARAN'];
        unlink("../transaksi/bukti/".$foto_lama);

        $query = "DELETE from pembayaran where ID_PEMBAYARAN='$id'";
        $result = mysqli_query($koneksi, $query);
        if (!$result) {
            die("Data gagal dhapus; ".mysqli_errno($koneksi).mysqli_error($koneksi));
        }
        else {
            echo "<script>alert('Data Berhasil Diubah');window.location.href='../tabeltransaksi.php'</script>";    }
}
?>