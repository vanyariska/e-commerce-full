<?php
include 'db.php';
$kontak=mysqli_query($conn,"SELECT admin_telp, admin_email, admin_address FROM tb_admin
WHERE admin_id=2" );

$a=mysqli_fetch_object($kontak);
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
                <input type="text" name="search" placeholder="Cari Produk">
                <input type="submit" name="cari" value ="Cari Produk">
            </form>
        </div>
    </div>
    <!----category---->
    <div class="section">
        <div class="container">
            <h3>Categories</h3>
            <div class="box">
                <?php
                $kategori=mysqli_query($conn,"SELECT*FROM tb_category ORDER BY category_id DESC");
                if(mysqli_num_rows($kategori)>0){
                    while($k=mysqli_fetch_array($kategori)){
                ?>
            <a href="produk.php?kat=<?php echo $k['category_id']?>">
                <div class="col-5">
                    <img src="img/menu.png" width="50px" style="margin-bottom:5px;">
                    <p><?php echo $k['category_name']?></p>
                </div>
            </a>
                <?php }}else{?>
                    <p>Category Not Available</p>
                <?php }?>
            </div>
        </div>
    </div>
    <!---new product---->
    <div class="section">
        <div class="container">
            <h3>New Products</h3>
            <div class="box">
                <?php
                    $produk=mysqli_query($conn,"SELECT*FROM tb_product ORDER BY product_id DESC
                    LIMIT 8");
                    if(mysqli_num_rows($produk)>0){
                        while($p=mysqli_fetch_array($produk)){
                ?>
                <a href="detail-produk.php?id=<?php echo $p['product_id']?>">
                <div class="col-4">
                    <img src="produk/<?php echo $p['product_image']?>">
                    <p class="nama"><?php echo substr($p['product_name'],0,30)?></p>
                    <p class="harga">Rp <?php echo number_format($p['product_price'])?>,00</p><br>
                    <a href="beli.php?id=<?php echo $p['product_id']?>"><input type="submit" name="beli" value ="Beli" class="btn-beli"></a>
                </div>
                </a>
                <?php   }}else{?>
                    <p>Procut Not Available</p>

                <?php }?>
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