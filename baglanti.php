<?php
$host = "localhost";       // Sunucu adresi
$kullanici = "root";       // MySQL kullanıcı adı (XAMPP kullanıyorsan genelde root)
$sifre = "";               // Şifre (XAMPP'de genelde boştur)
$veritabani = "teknokariyer";  // Veritabanı adı

// Bağlantıyı oluştur
$baglanti = mysqli_connect($host, $kullanici, $sifre, $veritabani);

// Bağlantı kontrolü
if (!$baglanti) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// Türkçe karakterler için charset ayarı
mysqli_set_charset($baglanti, "utf8");
?>
