<?php
session_start();
include("baglanti.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $sorgu = "DELETE FROM kullanicilar WHERE email = ?";
    $stmt = mysqli_prepare($baglanti, $sorgu);
    mysqli_stmt_bind_param($stmt, "s", $email);

    if (mysqli_stmt_execute($stmt)) {
        session_destroy();
        header("Location: login.html?silme=basarili");
        exit;
    } else {
        echo "Hesap silinemedi. Lütfen tekrar deneyin.";
    }
}
?>
