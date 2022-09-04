<?php
    error_reporting(0);
    include ('../../koneksi.php');

    if (isset($_GET['hapus'])) {
        $ID_BARANG = $_GET['hapus'];

        $file = mysqli_query($koneksi, "SELECT FOTO_BARANG FROM barang where ID_BARANG='$ID_BARANG'");
        $hasil = mysqli_fetch_array($file);
        $foto_lama=$hasil['FOTO_BARANG'];
        unlink("../imagebarang/".$foto_lama);

        $query = "DELETE from keranjang where ID_BARANG='$ID_BARANG'";
        $result = mysqli_query($koneksi, $query);
        $query2 = "DELETE from barang where ID_BARANG='$ID_BARANG'";
        $result2 = mysqli_query($koneksi, $query2);

        if (!$result||!$result) {
            die("Data gagal dhapus; ".mysqli_errno($koneksi).mysqli_error($koneksi));
        }
        else {
            echo "<script>alert('Data berhasil dihapus !');window.location.href='../../admin/index.php'</script>";
        }
    }
?>