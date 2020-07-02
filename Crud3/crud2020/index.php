<?php
 $server = "localhost";
 $user = "root";
 $pass = "";
 $database = "arkademy";

 $koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

//jika tombol simpan klick
 if(isset($_POST['bsimpan']))
 {
     ///pengujian apakah data akan diedit  atau disimpan baru
     if($_GET['hal'] == "edit")
     {
           //data akan diedit
          $edit = mysqli_query($koneksi, "UPDATE produk set
                                          nama_produk = '$_POST[tnama_produk]',
                                          keterangan = '$_POST[tketerangan]',
                                          harga = '$_POST[tharga]',
                                          jumlah = '$_POST[tjumlah]'
                                        WHERE id_produk = '$_GET[id]'
                                         ");
 
            if($edit) //jika edit sukses
             {
             echo "<script>
             alert('Edit data suksess!');
             document.location='index.php';
             </script>";
             } 
             else
             {
             echo "<script>
             alert('Edit data GAGAL!!');
             document.location='index.php';
             </script>";
 
             }   
     }
     else
     {
         //data akan disampan baru
         $simpan = mysqli_query($koneksi, "INSERT INTO produk (nama_produk, keterangan, harga, jumlah)
         VALUES ('$_POST[tnama_produk]',
                '$_POST[tketerangan]', 
                '$_POST[tharga]',
                '$_POST[tjumlah]')

         ");
            if($simpan) //jika simpan sukses  
            {
            echo "<script>
            alert('Simpan data suksess!');
            document.location='index.php';
            </script>";
            } 
            else
            {
            echo "<script>
            alert('Simpan data GAGAL!!');
            document.location='index.php';
            </script>";

            }                       
     }

          
 }

      //pengujian jika tombol edit /hapus di klick
      if(isset($_GET['hal']))
      {
          ///pengujian jika edit data
          if($_GET['hal'] == "edit")
          {
             // tampilkan Data yang akan diedit
             $tampil = mysqli_query($koneksi, "SELECT * FROM produk where id_produk = '$_GET[id]' ");
             $data = mysqli_fetch_array($tampil);
             if($data)
             {
                 //jika data ditemukan, maka data ditampung dulu ke dalam variable
                 $vnama_produk = $data['nama_produk'];
                 $vketerangan = $data['keterangan'];
                 $vharga = $data['harga'];
                 $vjumlah = $data['jumlah'];
                 
             }
          }
          else if($_GET['hal'] == "hapus")
          {
              /// Persiapan Hapus Data
              $hapus = mysqli_query($koneksi, "DELETE FROM produk where id_produk = '$_GET[id]' ");
              if($hapus){
                echo "<script>
                    alert('Hapus data suksess!!');
                    document.location='index.php';
                    </script>";
        
              }
          }
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <h1 class="text-center">BOOTCAMP ARCADEMY</h1>
    <h2 class="text-center">TOKO JUAL PRODUK</h2>

    <!-- awal -->
    <div class="card mt-3">
    <div class="card-header bg-primary text-white">
        Form Input Nama Barang
    </div>
    <div class="card-body">
       <form method="POST" action="">
           <div class="form-group">
               <label>Nama_produk</label>
               <input type="text" name="tnama_produk" value="<?=@$vnama_produk?>" class="form-control" placeholder="Input Nama Produk Anda" require>
          </div>
          <div class="form-group">
               <label>Keterangan</label>
               <input type="text" name="tketerangan" value="<?=@$vketerangan?>" class="form-control" placeholder="Keterangan Anda" require>
           </div>
           <div class="form-group">
               <label>Harga</label>
               <textarea class="form-control" name="tharga" placeholder="Input Harga"><?=@$vharga?></textarea>
           </div>
           <div class="form-group">
               <label>Jumlah</label>
               <input type="text" name="tjumlah"  value="<?=@$vjumlah?>" class="form-control" placeholder="Jumlah" require>
           </div>
           <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
           <button type="reset" class="btn btn-danger" name="breset">Kosongakn</button>

       </form>
    </div>
    </div>
    <!-- akhir card font-->


     <!-- awal card table -->
     <div class="card mt-3">
    <div class="card-header bg-success text-white">
        Tabel Produk
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>NO</th>
                <th>Nama_Produk</th>
                <th>Keterangan</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
            <?php
                $no = 1;
                $tampil =mysqli_query($koneksi, "SELECT * from produk order by id_produk desc");
                while($data = mysqli_fetch_array($tampil)) :


            ?>
            <tr>
                <td><?=$no++;?></td>
                <td><?=$data['nama_produk']?></td>
                <td><?=$data['keterangan']?></td>
                <td><?=$data['harga']?></td>
                <td><?=$data['jumlah']?></td>
                <td>
                    <a href="index.php?hal=edit&id=<?=$data['id_produk']?>" class="btn btn-warning"> Edit </a>
                    <a href="index.php?hal=hapus&id=<?=$data['id_produk']?>" 
                    onclick="return confirm('Apakah Yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
                </td>
            </tr>
                <?php  endwhile; //penutup perulangan while ?>
        </table>

        </div>
    </div>
    <!-- akhir card table-->

</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>