# Bootcamp-Arkademy
Ini Adalah Tugas 10 web Menggunakan CRUD

#catatan saya menghubungkan Framework Bootstrap
#tambah tampilan css
#Saya Menggunkan bahasa PHP dan Javascript
#Table Produk Menggunakan Database PhpMyAdmin

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
 
