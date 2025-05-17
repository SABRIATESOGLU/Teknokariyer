<?php
session_start();
include("baglanti.php");

// Giriş kontrolü
if (!isset($_SESSION['email'])) {
  header("Location: login.html");
  exit;
}

$ilan_id = $_POST['ilan_id'];
$kullanici_email = $_SESSION['email'];

// Kullanıcı ID'sini al
$sorgu = "SELECT id FROM kullanicilar WHERE email = '$kullanici_email'";
$sonuc = mysqli_query($baglanti, $sorgu);
$kullanici = mysqli_fetch_assoc($sonuc);
$kullanici_id = $kullanici['id'];

// Aynı ilana tekrar başvuru kontrolü
$kontrol = "SELECT * FROM basvurular WHERE kullanici_id = '$kullanici_id' AND ilan_id = '$ilan_id'";
$varmi = mysqli_query($baglanti, $kontrol);

if (mysqli_num_rows($varmi) > 0) {
  echo "<script>alert('Bu ilana zaten başvurdunuz.'); window.location.href='profile.php';</script>";
  exit;
}

// Başvuru kaydı ekle
$ekle = "INSERT INTO basvurular (kullanici_id, ilan_id) VALUES ('$kullanici_id', '$ilan_id')";
if (mysqli_query($baglanti, $ekle)) {
  echo "<script>alert('Başvurunuz başarıyla alındı.'); window.location.href='profile.php';</script>";
} else {
  echo "Hata oluştu: " . mysqli_error($baglanti);
}

mysqli_close($baglanti);
?>
