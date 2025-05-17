<?php
session_start();
include("baglanti.php");

if (!isset($_SESSION['email']) || $_SESSION['turu'] != 'employer') {
  header("Location: login.html");
  exit;
}

$basvuru_id = $_POST['id'];
$action = $_POST['action'];

if ($action == 'onayla') {
  $durum = 'Onaylandı';
} elseif ($action == 'reddet') {
  $durum = 'Reddedildi';
} else {
  header("Location: employer_applications.php");
  exit;
}

$sorgu = "UPDATE basvurular SET durum = '$durum' WHERE id = $basvuru_id";
if (mysqli_query($baglanti, $sorgu)) {
  header("Location: employer_applications.php");
} else {
  echo "Hata: " . mysqli_error($baglanti);
}
?>
