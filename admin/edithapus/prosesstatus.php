<?php
    include '../../koneksi.php';
    session_start();
                $no=0;
                $result=mysqli_query($koneksi, "SELECT * FROM keranjang INNER JOIN barang ON keranjang.ID_BARANG=barang.ID_BARANG INNER JOIN pembayaran ON keranjang.ID_KERANJANG=pembayaran.ID_KERANJANG INNER JOIN penjual ON penjual.ID_LAPAK=pembayaran.ID_LAPAK WHERE EMAIL_PENJUAL = '$_SESSION[EMAIL_PENJUAL]'");
                while($row=mysqli_fetch_array($result)) {
                ?>
<?php


    if (isset($_POST['edit'])) {
        $STATUS_PEMBAYARAN=$_POST['STATUS_PEMBAYARAN'];

        $query2 = "UPDATE pembayaran set STATUS_PEMBAYARAN = '$STATUS_PEMBAYARAN' where ID_PEMBAYARAN = '$row[ID_PEMBAYARAN]'";
        $result2 = mysqli_query($koneksi, $query2);

        if (!$result2) {
            die("Data gagal di ubah; ".mysqli_errno($koneksi).mysqli_error($koneksi));
        }
        else {
            
            echo "<script>alert('Data Berhasil Diubah');window.location.href='../tabeltransaksi.php'</script>";
        }
    }

?>
<?php }?>