<?php
include_once("../connect.php");

// Check If form submitted, insert form data into users table.
if (isset($_POST['submit'])) {
	$isbn = $_POST['isbn'];
	$judul = $_POST['judul'];
	$tahun = $_POST['tahun'];
	$id_penerbit = $_POST['id_penerbit'];
	$id_pengarang = $_POST['id_pengarang'];
	$id_katalog = $_POST['id_katalog'];
	$qty_stok = $_POST['qty_stok'];
	$harga_pinjam = $_POST['harga_pinjam'];

	$result = mysqli_query($connect, "INSERT INTO `buku` (`isbn`, `judul`, `tahun`, `id_penerbit`, `id_pengarang`, `id_katalog`, `qty_stok`, `harga_pinjam`) VALUES ('$isbn', '$judul', '$tahun', '$id_penerbit', '$id_pengarang', '$id_katalog', '$qty_stok', '$harga_pinjam');");
	header("Location:index.php");
}
