<?php
session_start();
//mendapatkan id produk dr url
$id_produk=$_GET['id'];


//jika sudah ada produk dikeranjang,maka produk jumlah +1
if(isset($_SESSION['keranjang'][$id_produk])){
    $_SESSION['keranjang'][$id_produk]+=1;
}
//jika keranjang kosong
else{
    $_SESSION['keranjang'][$id_produk]=1;
}
//echo"<pre>";
//print_r($_SESSION);
//echo"</pre>";

//larikan ke halaman keranjang
echo"<script>alert('Produk Telah Dimasukkan Ke Keranjang');</script>";
echo"<script>location='keranjang.php';</script>";

?>
