<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login']!=true ){
        echo '<script>window_location="login.php"</script>';
    }
    $produk=mysqli_query($conn,"SELECT*FROM tb_product WHERE product_id='".$_GET['id']."'");
    if(mysqli_num_rows($produk)==0){
        echo'<script>window.location="data-produk.php"</script>';
    }
    $p=mysqli_fetch_object($produk);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product-NoInscure | E-Commerce </title>
    <link rel="stylesheet" type="text/css" href="css/style4.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
</head>
<body>
    <!--header--->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">NoInscure | E-Commerce</a></h1>
            <ul>
                <li><a href="dashboard.php"></a>Dashboard</li>
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
            <h3>Edit Product Data</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">---Pilih---</option>
                        <?php
                            $kategori=mysqli_query($conn,"SELECT*FROM tb_category ORDER BY category_id DESC");
                            while($r=mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_id'] ?>"<?php echo ($r['category_id']==$p->category_id)?'selected':'';?>>
                        <?php echo $r['category_name'] ?></option>
                        <?php }?>
                    </select>
                    <input type="text" name="nama" placeholder="Masukkan Nama Produk" class="input-control" value="<?php echo $p->product_name ?>" required>
                    <input type="text" name="harga" placeholder="Masukkan Harga Produk" class="input-control" value="<?php echo $p->product_price?>" required>

                    <img src="produk/<?php echo $p->product_image?>" width="100px">
                    <input type="hidden" name="foto" value="<?php echo $p->product_image?>">
                    <input type="file" name="gambar" class="input-control">
                    <textarea name="deskripsi" class="input-control" placeholder="Masukkan Deskripsi Produk"><?php echo $p->product_description?></textarea><br>
                    <select name="status" class="input-control">
                        <option value="">---Pilih---</option>
                        <option value="1" <?php echo ($p->product_status==1)?'selected':''?>>Aktif</option>
                        <option value="0" <?php echo ($p->product_status==0)?'selected':''?>>Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        //data inputan dari form
                        $kategori =$_POST['kategori'];
                        $nama     =$_POST['nama'];
                        $harga    =$_POST['harga'];
                        $deskripsi=$_POST['deskripsi'];
                        $status   =$_POST['status'];
                        $foto     =$_POST['foto'];

                        //data gambar yang baru
                        $filename=$_FILES['gambar']['name'];
                        $tmp_name=$_FILES['gambar']['tmp_name'];
                        
                        $type1=explode('.',$filename);
                        $type2=$type1[1];

                        $newname='produk'.time().'.'.$type2;

                        //menampung data format file yang diizinkan
                        $tipe_diizinkan=array('jpg','jpeg','png','gif');

                        //validasi admin ganti gambar
                        if($filename != ''){
                            if(!in_array($type2,$tipe_diizinkan)){
                                echo '<script>alert("Format File Tidak Diizinkan")</script>';
                            }else{
                                unlink('./produk/'.$foto);
                                move_uploaded_file($tmp_name,'./produk/'.$newname);
                                $namagambar=$newname;
                            }
                        }else{
                            //validasi admin tdk ganti gambar
                            $namagambar=$foto;


                        }
                        //query update
                        $update=mysqli_query($conn,"UPDATE tb_product SET
                        category_id='".$kategori."',
                        product_name='".$nama."',
                        product_price='".$harga."',
                        product_description='".$deskripsi."',
                        product_image='".$namagambar."',
                        product_status='".$status."' 
                        WHERE product_id='".$p->product_id."'");

                        //validasi update
                        if($update){
                            echo '<script>alert("Produk Berhasil Diubah")</script>';
                            echo '<script>window.location="data-produk.php"</script>';
                        }else{
                            echo 'Data Gagal Diubah!!'.mysqli_error($conn);
                        }

                    } 
                ?>
            </div>
        </div>
     </div>
     <!----footer--->
     <div class="container">
        <small>Copyright &copy; 2022 - Vanyariska Indriani</small>
     </div>
     <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>