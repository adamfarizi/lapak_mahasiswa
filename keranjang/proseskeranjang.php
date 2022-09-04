<?php
        $id = ($_GET["detail2"]);
    session_start();
        	include '../koneksi.php';
$query = mysqli_query($koneksi,"SELECT ID_BARANG FROM keranjang WHERE ID_BARANG='$id'");
        if (mysqli_fetch_assoc($query)) {
            echo"<script>
                    alert('Barang Sudah Anda masukan ke KERANJANG');
                </script>";
            echo "<script>location='../home.php'</script>";
        }else{
    if (!empty($_SESSION['EMAIL_PENGGUNA'])) {

    	$query1 = mysqli_query($koneksi, "SELECT max(ID_KERANJANG) as kodeTerbesar FROM keranjang");
        $data1 = mysqli_fetch_array($query1);
        $ID_KERANJANG = $data1['kodeTerbesar'];

        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($ID_KERANJANG, 3, 3);
                
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;
                
        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $angka = "KRJ";
        $ID_KERANJANG = $angka . sprintf("%03s", $urutan);
        $EMAIL_PENGGUNA=$_SESSION['EMAIL_PENGGUNA'];
        $TGL_KERANJANG=date("Y:m:d");
        $PESAN_KERANJANG= 1;

        $query2 = "INSERT INTO keranjang VALUES ('$ID_KERANJANG' , '$id', '$EMAIL_PENGGUNA', '$TGL_KERANJANG', '$PESAN_KERANJANG')";
        $result = mysqli_query($koneksi, $query2);



        if (!$result) {
        die ("Query gagal dijalankan: ". mysqli_errno($koneksi). " - ". mysqli_error($koneksi));
        }
        else {
        	echo "<script> window.location.href='../transaksi/alerttransaksi.php'</script>";
        }
    }
}
?>