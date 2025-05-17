<?php
session_start();
include("baglanti.php");

if (!isset($_SESSION['email']) || $_SESSION['turu'] != 'employer') {
  header("Location: login.html");
  exit;
}

$employer_id = $_SESSION['kullanici_id'];
$ilanlar_sorgu = "SELECT id FROM ilanlar WHERE kullanici_id = '$employer_id'";
$ilanlar_sonuc = mysqli_query($baglanti, $ilanlar_sorgu);

$ilan_idler = [];
while ($row = mysqli_fetch_assoc($ilanlar_sonuc)) {
  $ilan_idler[] = $row['id'];
}

if (empty($ilan_idler)) {
  echo "<p>Henüz hiç ilan yayınlamadınız.</p>";
  exit;
}

$id_listesi = implode(",", $ilan_idler);

$basvuru_sorgu = "
  SELECT b.id AS basvuru_id, k.adsoyad, k.email, i.pozisyon, b.durum, b.tarih
  FROM basvurular b
  JOIN kullanicilar k ON b.kullanici_id = k.id
  JOIN ilanlar i ON b.ilan_id = i.id
  WHERE b.ilan_id IN ($id_listesi)
  ORDER BY b.tarih DESC
";
$basvuru_sonuc = mysqli_query($baglanti, $basvuru_sorgu);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Gelen Başvurular | Teknokariyer</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f4f6f7;
    }

    header {
      background-color: #2e86de;
      color: white;
      padding: 20px;
      text-align: center;
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
    }

    .form-container {
      max-width: 1000px;
      margin: 50px auto;
      padding: 30px;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 25px;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: center;
    }

    th {
      background-color: #f1c40f;
      color: #000;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    button {
      padding: 6px 12px;
      margin: 0 5px;
      background-color: #2e86de;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #1b4f72;
    }

    footer {
      margin-top: 50px;
      text-align: center;
      padding: 20px;
      background-color: #2e86de;
      color: white;
    }
  </style>
</head>
<body>
  <header>
    <h1>Teknokariyer</h1>
    <nav>
      <ul>
        <li><a href="employer_panel.php">İlan Yayınla</a></li>
        <li><a href="profile.php">Profilim</a></li>
        <li><a href="logout.php">Çıkış Yap</a></li>
      </ul>
    </nav>
  </header>

  <main class="form-container">
    <h2>Gelen Başvurular</h2>

    <?php if (mysqli_num_rows($basvuru_sonuc) > 0): ?>
      <table>
        <tr>
          <th>Ad Soyad</th>
          <th>E-posta</th>
          <th>Pozisyon</th>
          <th>Başvuru Tarihi</th>
          <th>Durum</th>
          <th>İşlem</th>
        </tr>
        <?php while ($basvuru = mysqli_fetch_assoc($basvuru_sonuc)): ?>
          <tr>
            <td><?php echo htmlspecialchars($basvuru['adsoyad']); ?></td>
            <td><?php echo htmlspecialchars($basvuru['email']); ?></td>
            <td><?php echo htmlspecialchars($basvuru['pozisyon']); ?></td>
            <td><?php echo $basvuru['tarih']; ?></td>
            <td><?php echo $basvuru['durum']; ?></td>
            <td>
              <?php if ($basvuru['durum'] == 'Beklemede'): ?>
                <form action="update_application.php" method="POST" style="display:inline;">
                  <input type="hidden" name="id" value="<?php echo $basvuru['basvuru_id']; ?>">
                  <button name="action" value="onayla">Onayla</button>
                  <button name="action" value="reddet" style="background-color: #e74c3c;">Reddet</button>
                </form>
              <?php else: ?>
                <strong><?php echo $basvuru['durum']; ?></strong>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    <?php else: ?>
      <p>Henüz başvuru bulunmuyor.</p>
    <?php endif; ?>
  </main>

  <footer>
    <p>© 2025 Teknokariyer. Tüm hakları saklıdır.</p>
  </footer>
</body>
</html>
