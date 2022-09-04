<?php
    error_reporting(0);
    include ('../koneksi.php');

    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];

        $query = "DELETE from keranjang where ID_KERANJANG='$id'";
        $result = mysqli_query($koneksi, $query);
        if (!$result) {
            die("Data gagal dhapus; ".mysqli_errno($koneksi).mysqli_error($koneksi));
        }
        else {
        	echo "<script> window.location.href='../home.php'</script>";
        }
}
?>