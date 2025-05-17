<?php
session_start();
include("baglanti.php");

if (!isset($_SESSION['email'])) {
  header("Location: login.html");
  exit;
}

$email = $_SESSION['email'];
$fullname = $_POST['fullname'];
$yeni_sifre = $_POST['password'];

// Şifre girildiyse güncelle, girilmediyse sadece ad soyad
if (!empty($yeni_sifre)) {
  $sifre_hash = password_hash($yeni_sifre, PASSWORD_DEFAULT);
  $sorgu = "UPDATE kullanicilar SET adsoyad='$fullname', sifre='$sifre_hash' WHERE email='$email'";
} else {
  $sorgu = "UPDATE kullanicilar SET adsoyad='$fullname' WHERE email='$email'";
}

if (mysqli_query($baglanti, $sorgu)) {
  echo "<script>alert('Profil güncellendi'); window.location.href='profile.php';</script>";
} else {
  echo "Hata oluştu: " . mysqli_error($baglanti);
}

mysqli_close($baglanti);
?>
