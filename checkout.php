<?php 
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <link rel="stylesheet" type="text/css" href="css/style5.css"/>
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
    <!---contain---->
    <section class="konten">
        <div class="container">
            <h1>Keranjang Belanja</h1>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor=1;?>
                    <?php $totalbelanja=0?>
                    <?php foreach ($_SESSION['keranjang'] 
                    as $id_produk => $jumlah):?>
                    <!---menampilkan produk--->
                    <?php 
                    $ambil=$conn->query("SELECT*FROM tb_product
                    WHERE product_id='$id_produk'");
                    $pecah=$ambil->fetch_assoc();
                    $subharga= $pecah['product_price']*$jumlah;
                    ?>
                    <tr>
                        <td><?php echo $nomor ;?></td>
                        <td><?php echo $pecah['product_name'];?></td>
                        <td>Rp <?php echo number_format($pecah['product_price']);?>,00</td>
                        <td><?php echo $jumlah ;?></td>
                        <td>Rp <?php echo number_format($subharga);?>,00</td>
                    </tr>
                    <?php $nomor++;?>
                    <?php $totalbelanja+=$subharga ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                            <th>Rp <?php echo number_format($totalbelanja);?>,00</th>
                   </tr>
                </tfoot>
            </table>
        </div>
    </section>
</body>
</html>