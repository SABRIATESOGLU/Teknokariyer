<?php
session_start();
include("baglanti.php");

if (!isset($_SESSION['email']) || ($_SESSION['turu'] != 'jobseeker' && $_SESSION['turu'] != 'student')) {
    header("Location: login.html");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];

// Başvurular ve ilan bilgilerini al
$sorgu = "
    SELECT i.pozisyon, i.sirket, i.konum, i.tur, b.tarih, b.durum
    FROM basvurular b
    JOIN ilanlar i ON b.ilan_id = i.id
    WHERE b.kullanici_id = '$kullanici_id'
    ORDER BY b.tarih DESC
";

$sonuc = mysqli_query($baglanti, $sorgu);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Başvurularım | Teknokariyer</title>
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
  background: linear-gradient(to right, #ffcc00, #ffb300); /* Renk geçişi */
  border-radius: 15px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  color: #000;
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 25px;
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
  font-weight: 600; /* Kalın yazı */
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
  font-weight: 600;
}

button:hover {
  background-color: #333;
  transform: scale(1.05);
}

button:active {
  background-color: #555;
}

footer {
  margin-top: 50px;
  text-align: center;
  padding: 20px;
  background-color: #2e86de;
  color: white;
  font-size: 16px;
  box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
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
  font-weight: 600;
  transition: all 0.3s ease;
}

a.button:hover {
  background-color: #333;
  transform: scale(1.05);
}

a.button:active {
  background-color: #555;
}

    </style>
</head>
<body>
    <header>
        <h1>Teknokariyer</h1>
        <nav>
            <ul>
                <li><a href="jobs.php">İlanlar</a></li>
                <li><a href="profile.php">Profilim</a></li>
                <li><a href="logout.php">Çıkış Yap</a></li>
            </ul>
        </nav>
    </header>

    <main class="form-container">
        <h2>Başvurularım</h2>

        <?php if (mysqli_num_rows($sonuc) > 0): ?>
            <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th>Pozisyon</th>
                    <th>Şirket</th>
                    <th>Konum</th>
                    <th>Tür</th>
                    <th>Başvuru Tarihi</th>
                    <th>Durum</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($sonuc)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['pozisyon']); ?></td>
                        <td><?php echo htmlspecialchars($row['sirket']); ?></td>
                        <td><?php echo htmlspecialchars($row['konum']); ?></td>
                        <td><?php echo htmlspecialchars($row['tur']); ?></td>
                        <td><?php echo $row['tarih']; ?></td>
                        <td><?php echo $row['durum']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Henüz bir başvurunuz bulunmuyor.</p>
        <?php endif; ?>
    </main>
</body>
</html>
