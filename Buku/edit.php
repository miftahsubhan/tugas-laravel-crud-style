<?php
include_once("../connect.php");

// Check If form submitted, insert form data into users table.
if(isset($_POST['update'])) {
	$isbn = $_GET['isbn'];
	
	$judul = $_POST['judul'];
	$tahun = $_POST['tahun'];
	$id_penerbit = $_POST['id_penerbit'];
	$id_pengarang = $_POST['id_pengarang'];
	$id_katalog = $_POST['id_katalog'];
	$qty_stok = $_POST['qty_stok'];
	$harga_pinjam = $_POST['harga_pinjam'];

	$result = mysqli_query($connect, "UPDATE buku 
		SET judul = '$judul', tahun = '$tahun', id_penerbit = '$id_penerbit', 
		 	id_pengarang = '$id_pengarang', id_katalog = '$id_katalog', 
			qty_stok = '$qty_stok', harga_pinjam = '$harga_pinjam' 
		WHERE isbn = '$isbn';");
			
	header("Location:index.php");
}
?>
