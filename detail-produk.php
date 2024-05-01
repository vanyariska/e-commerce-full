<?php
error_reporting(0);
include 'db.php';
$kontak=mysqli_query($conn,"SELECT admin_telp, admin_email, admin_address FROM tb_admin
WHERE admin_id=2" );

$a=mysqli_fetch_object($kontak);

$produk=mysqli_query($conn,"SELECT*FROM tb_product WHERE product_id ='".$_GET['id']."'");
$p=mysqli_fetch_object($produk);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoInscure | E-Commerce </title>
    <link rel="stylesheet" type="text/css" href="css/style4.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!--header--->
    <header>
        <div class="container">
            <h1><a href="index.php">NoInscure | E-Commerce</a></h1>
            <ul>
                <li><a href="produk.php">Produk</a></li>
            </ul>
        </div>
    </header>
    <!---search--->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search']?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>"> 
                <input type="submit" name="cari" value ="Cari Produk">
            </form>
        </div>
    </div>
    <!----product detail----->
    <div class="section">
        <div class="container">
        <h3>Detail Product</h3>
            <div class="box">
                <div class="col-2">
                    <img src="produk/<?php echo $p->product_image ?>" width="85%">
                </div>
                <div class="col-2">
                    <h3><?php echo $p->product_name?></h3>
                    <h4>Rp<?php echo number_format($p->product_price)?>,00</h4>
                    <p>Deskripsi:
                        <?php echo $p->product_description?></p>
                </div>
            </div>
        </div>
    </div>
    <!---footer--->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->admin_address?></p>

            <h4>Email</h4>
            <p><?php echo $a->admin_email?></p>

            <h4>No. Hp</h4>
            <p><?php echo $a->admin_telp?></p>

            <small>Copyright &copy; 2021-Vanyariska Indriani</small>
        </div>
    </div>
</body>
</html>