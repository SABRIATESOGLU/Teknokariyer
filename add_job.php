<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("baglanti.php");

// Giriş yapan işverenin ID'si oturumdan alınır
$kullanici_id = $_SESSION['kullanici_id'] ?? null;

// Formdan gelen verileri al
$pozisyon = $_POST['job_title'] ?? null;
$sirket = $_POST['company'] ?? null;
$konum = $_POST['location'] ?? null;
$tur = $_POST['type'] ?? null;
$aciklama = $_POST['description'] ?? null;

// Formdan gelen verileri test et (isteğe bağlı debug)
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Gerekli alanlar dolu mu?
if ($pozisyon && $sirket && $konum && $tur && $aciklama && $kullanici_id) {
    $sorgu = "INSERT INTO ilanlar (pozisyon, sirket, konum, tur, aciklama, kullanici_id) 
              VALUES ('$pozisyon', '$sirket', '$konum', '$tur', '$aciklama', '$kullanici_id')";

    $calistir = mysqli_query($baglanti, $sorgu);

    if ($calistir) {
        echo "<script>alert('İlan başarıyla eklendi!'); window.location.href='employer_panel.php';</script>";
    } else {
        echo "Hata oluştu: " . mysqli_error($baglanti);
    }
} else {
    echo "Lütfen tüm alanları doldurun veya tekrar giriş yapın.";
}

mysqli_close($baglanti);
?>
