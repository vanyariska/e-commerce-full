<?php
include 'connect.php';
if(isset($_POST['insert'])){
$kode=$_POST['kode'];
$nama=$_POST['nama'];
$harga=$_POST['harga'];
$deskripsi=$_POST['deskripsi'];
$gambar=$_FILES['gambar']['name'];

//accessing gambar
$temp_gambar=$_FILES['gambar']['tmp_name'];

//check empty condition
if($kode==''or $nama==''or $harga==''){
    echo"<script>alert('Silahkan Melengkapi Data Yang Masih Kosong')</script>";
    exit();
}else{
    move_uploaded_file($temp_gambar,$gambar);

    //insert query
    $insert="insert into `produkku` (kode,nama,harga,deskripsi,gambar) values ('$kode','$nama','$harga','$deskripsi','$gambar',NOW())";
    $result_query=mysqli_query($con,$insert);
    if($result_query){
        echo"<script>alert('Produk Berhasil Ditambahkan')</script>";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard-NoInsecure | Add Products</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Product</h1>
        <!--form-->
        <form action="" method="post" enctype="multipart/form-data">
        <!--kode-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="kode" class="form-label">
                Kode Produk
                </label>
                <input type="text" name="kode" 
                id="kode" 
                class="form-control" 
                placeholder="Masukkan Kode Produk" autocomplete="off"
                required="required">
            </div>    
        <!--nama-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="nama" class="form-label">
                Nama Produk
                </label>
                <input type="text" name="nama" 
                id="nama" 
                class="form-control" 
                placeholder="Masukkan Nama Produk" autocomplete="off"
                required="required">
            </div>
        <!--harga-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="harga" class="form-label">
                Harga Produk
                </label>
                <input type="text" name="harga" 
                id="harga" 
                class="form-control" 
                placeholder="Masukkan Harga Produk" autocomplete="off"
                required="required">
            </div>
        <!--deskripsi-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="deskripsi" class="form-label">
                Deskripsi Produk
                </label>
                <input type="text" name="deskripsi" 
                id="deskripsi" 
                class="form-control" 
                placeholder="Masukkan Deskripsi Produk" autocomplete="off"> 
            </div>
         <!--gambar-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="gambar" class="form-label">
                Gambar Produk
                </label>
                <input type="file" name="gambar" 
                id="gambar" 
                class="form-control"> 
            </div>
        <!--submit-->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert" 
                class="btn btn-secondary mb-3 px-3" value="Tambahkan Produk"> 
            </div>

        </form>

    </div>



















<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>