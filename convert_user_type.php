<?php
session_start();
include("baglanti.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Kullanıcıyı güncelle
    $sorgu = "UPDATE kullanicilar SET kullanici_turu = 'jobseeker' WHERE email = '$email'";
    if (mysqli_query($baglanti, $sorgu)) {
        $_SESSION['turu'] = 'jobseeker'; // oturum bilgisini de güncelle
        echo "<script>alert('Tebrikler! Artık iş arayan olarak devam ediyorsunuz.'); window.location.href='profile.php';</script>";
    } else {
        echo "Hata oluştu: " . mysqli_error($baglanti);
    }
} else {
    header("Location: profile.php");
    exit;
}
