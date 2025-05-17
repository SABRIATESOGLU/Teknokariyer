<?php
session_start(); // Oturumu başlat
session_unset(); // Tüm oturum değişkenlerini temizle
session_destroy(); // Oturumu sonlandır

// Ana sayfaya veya login.html'e yönlendir
header("Location: login.html");
exit;
?>
