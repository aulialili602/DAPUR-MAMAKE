<?php
$host = "localhost";    // biasanya localhost
$user = "root";         // username database, default: root
$pass = "";             // password database (default kosong jika di XAMPP)
$db   = "db_resep";        // nama database kamu

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
