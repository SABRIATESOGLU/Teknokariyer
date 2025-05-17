<?php
session_start();
include("baglanti.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
  echo "Geçersiz ilan ID'si.";
  exit;
}

$id = intval($_GET['id']); // güvenlik için sayıya çevir

$sorgu = "SELECT * FROM ilanlar WHERE id = $id";
$sonuc = mysqli_query($baglanti, $sorgu);

if (mysqli_num_rows($sonuc) == 0) {
  echo "İlan bulunamadı.";
  exit;
}

$ilan = mysqli_fetch_assoc($sonuc);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>İlan Detayı | Teknokariyer</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  background-color: #f4f6f7;
  color: #333;
}

header {
  background-color: #2e86de;
  color: white;
  padding: 20px;
  text-align: center;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

nav ul li {
  display: inline;
  margin: 0 15px;
}

nav a {
  color: white;
  text-decoration: none;
  font-weight: bold;
  font-size: 18px;
}

.form-container {
  max-width: 900px;
  margin: 50px auto;
  padding: 40px;
  background: linear-gradient(to right, #ffcc00, #ffb300);
  border-radius: 15px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  color: #000;
  font-size: 32px; /* Daha büyük başlık */
  font-weight: 700; /* Kalın font */
  margin-bottom: 25px;
}

p {
   
  color: #000;
  font-size: 15px; /* Daha büyük başlık */
  font-weight: 700; /* Kalın font */
  margin-bottom: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 25px;
}

th, td {
  border: 1px solid #ddd;
  padding: 15px;
  text-align: center;
  font-size: 16px;
}

th {
  background-color: #f1c40f;
  color: #000;
  font-weight: bold;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}

button {
  padding: 10px 20px;
  margin: 10px 5px;
  background-color: #000;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 600; /* Kalın yazı */
}

button:hover {
  background-color: #333;
  transform: scale(1.05);
}

button:active {
  background-color: #555;
}

 

a.button {
  background-color: #000;
  padding: 12px 25px;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  text-align: center;
  display: inline-block;
  font-size: 16px;
  margin-top: 20px;
  font-weight: 600; /* Kalın yazı */
  transition: all 0.3s ease;
}

a.button:hover {
  background-color: #333;
  transform: scale(1.05);
}

a.button:active {
  background-color: #555;
}
footer {
    text-align: center;
    background: #2e86de;
    color: #FFFFFF;
    padding: 10px;
  }
  </style>
</head>
<body>
  <header>
    <h1>Teknokariyer</h1>
    <nav>
      <ul>
        <li><a href="index.html">Ana Sayfa</a></li>
        <li><a href="jobs.php">Tüm İlanlar</a></li>
      </ul>
    </nav>
  </header>

  <main class="form-container">
    <h2><?php echo htmlspecialchars($ilan['pozisyon']); ?></h2>
    <p><strong>Şirket:</strong> <?php echo htmlspecialchars($ilan['sirket']); ?></p>
    <p><strong>Konum:</strong> <?php echo htmlspecialchars($ilan['konum']); ?></p>
    <p><strong>Çalışma Türü:</strong> <?php echo htmlspecialchars($ilan['tur']); ?></p>
    <p><strong>Açıklama:</strong> <?php echo nl2br(htmlspecialchars($ilan['aciklama'])); ?></p>
     

    <!-- Başvuru Butonu -->
    <?php if (isset($_SESSION['turu']) && ($_SESSION['turu'] == 'jobseeker' || $_SESSION['turu'] == 'student')): ?>
      <form action="apply.php" method="POST">
        <input type="hidden" name="ilan_id" value="<?php echo $ilan['id']; ?>">
        <button type="submit" class="button">İlana Başvur</button>
      </form>
    <?php else: ?>
      <p><strong>İş veren olduğunuz için başvuru yapamazssınız.</strong></p>
    <?php endif; ?>

    <br>
    <a href="jobs.php" class="button">← Geri Dön</a>
  </main>

  <footer>
    <p >© 2025 Teknokariyer. Tüm hakları saklıdır.</p>
  </footer>
</body>
</html>
