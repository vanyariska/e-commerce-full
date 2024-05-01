<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login']!=true ){
        echo '<script>window_location="login.php"</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-NoInscure | E-Commerce </title>
    <link rel="stylesheet" type="text/css" href="css/style4.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!--header--->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">NoInscure | E-Commerce</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>
    <!----content--->
     <div class="section">
        <div class="container">
            <h3>Products</h3>
            <div class="box">
                <p><a href="tambah-produk.php">Add Product</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px" >No</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                            $produk=mysqli_query($conn,"SELECT*FROM tb_product LEFT JOIN tb_category USING(category_id)  ORDER BY product_id DESC");
                            if(mysqli_num_rows($produk)>0){
                            while($row=mysqli_fetch_array($produk)){
                        ?>
                        <tr>
                            <td><?php echo $no++?></td>
                            <td><?php echo $row['category_name']?></td>
                            <td><?php echo $row['product_name']?></td>
                            <td>Rp <?php echo number_format($row['product_price'])?>,00</td>
                            <td><?php echo $row['product_description']?></td>
                            <td><img src="produk/<?php echo $row['product_image']?>" width="50px"></td>
                            <td><?php echo ($row['product_status']==0)?'Tidak Aktif':'Aktif';?></td>
                            <td>
                                <a href="edit-produk.php?id=<?php echo $row['product_id']?>">Edit</a> || <a href="
                                proses-hapus.php?idp=<?php echo $row['product_id']?>" onclick="return confirm('Yakin Ingin Menghapus Produk?')">Delete</a>
                            </td>
                        </tr>
                        <?php }}else{?>
                            <tr>
                                <td colspan="8">Tidak Ada Data Produk</td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
     </div>
     <!----footer--->
     <div class="container">
        <small>Copyright &copy; 2022 - Vanyariska Indriani</small>
     </div>
</body>
</html>