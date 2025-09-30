<?php
$host = "localhost";
$user = "root";      // XAMPP varsayılan kullanıcı
$pass = "";          // XAMPP varsayılan şifre boş
$db   = "staj_sistemi"; // phpMyAdmin’de oluşturacağın veritabanı adı

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}
?>
