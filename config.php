<?php
$host = "localhost";
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$database = "db_sima_new"; // Ganti dengan nama database Anda

$conn = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno()) {
	echo "koneksi gagal : ".mysqli_connect_error();
}