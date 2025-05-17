<?php
include("baglanti.php");

$adsoyad = $_POST['fullname'];
$email = $_POST['email'];
$sifre = $_POST['password'];
$kullanici_turu = $_POST['userType'];

// Şifreyi güvenli hale getir
$sifre_hashli = password_hash($sifre, PASSWORD_DEFAULT);

// Aynı email varsa kaydetme
$sorgu = "SELECT * FROM kullanicilar WHERE email = '$email'";
$kontrol = mysqli_query($baglanti, $sorgu);

if (mysqli_num_rows($kontrol) > 0) {
  echo "Bu e-posta zaten kayıtlı.";
} else {
  $ekle = "INSERT INTO kullanicilar (adsoyad, email, sifre, kullanici_turu) 
           VALUES ('$adsoyad', '$email', '$sifre_hashli', '$kullanici_turu')";
  
  if (mysqli_query($baglanti, $ekle)) {
    echo "<script>alert('Kayıt başarılı! Giriş yapabilirsiniz.'); window.location.href='login.html';</script>";
  } else {
    echo "Hata oluştu: " . mysqli_error($baglanti);
  }
}

mysqli_close($baglanti);
?>
