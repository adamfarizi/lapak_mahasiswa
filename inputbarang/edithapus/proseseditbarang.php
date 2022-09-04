<?php
    error_reporting(0);
    include '../../koneksi.php';

    if (isset($_POST['edit'])) {
        $ID_BARANG=$_POST['ID_BARANG'];
        $ID_LAPAK=$_POST['ID_LAPAK'];
        $NAMA_BARANG=$_POST['NAMA_BARANG'];
        $HARGA_BARANG=$_POST['HARGA_BARANG'];
        $JENIS_BARANG=$_POST['JENIS_BARANG'];
        $STOK_BARANG=$_POST['STOK_BARANG'];
        $DESKRIPSI_BARANG=$_POST['DESKRIPSI_BARANG'];
        $FOTO_BARANG=$_FILES['FOTO_BARANG']['name'];
        $tmp=$_FILES['FOTO_BARANG']['tmp_name'];
        $path="../imagebarang/".$FOTO_BARANG;

        if (empty($foto)) {
            $query = "UPDATE barang set NAMA_BARANG = '$NAMA_BARANG', HARGA_BARANG = '$HARGA_BARANG', JENIS_BARANG = '$JENIS_BARANG', 
            STOK_BARANG = '$STOK_BARANG', DESKRIPSI_BARANG = '$DESKRIPSI_BARANG' where ID_BARANG = '$ID_BARANG'";
        }
        else {
            $file = mysqli_query($koneksi, "SELECT FOTO_BARANG FROM barang where ID_BARANG='$ID_BARANG'");
            $hasil = mysqli_fetch_array($file);
            $foto_lama=$hasil['FOTO_BARANG'];
            unlink("../imagebarang/".$foto_lama);

            if (move_uploaded_file($tmp, $path)) {
                $query = "UPDATE barang set NAMA_BARANG = '$NAMA_BARANG', HARGA_BARANG = '$HARGA_BARANG', JENIS_BARANAG = '$JENIS_BARANG', 
                STOK_BARANG = '$STOK_BARANG', DESKRIPSI_BARANG = '$DESKRIPSI_BARANG', FOTO_BARANG = '$FOTO_BARANG' where ID_BARANG = '$ID_BARANG'";
            }
        }

        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Data gagal di ubah; ".mysqli_errno($koneksi).mysqli_error($koneksi));
        }
        else {
            echo "<script>alert('Data Berhasil Diubah');window.location.href='../../admin/index.php'</script>";
        }
    }

?>