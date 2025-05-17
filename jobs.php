<?php
session_start();
include("baglanti.php");

$turu = $_SESSION['turu'] ?? null;

// Filtre verilerini al
$konum_filter = $_GET['konum'] ?? '';
$tur_filter = $_GET['tur'] ?? '';
$pozisyon_filter = $_GET['pozisyon'] ?? '';

// Temel sorgu
if ($turu === 'student') {
    $sorgu = "SELECT * FROM ilanlar WHERE tur = 'Staj'";
} elseif ($turu === 'jobseeker') {
    $sorgu = "SELECT * FROM ilanlar WHERE tur != 'Staj'";
} else {
    $sorgu = "SELECT * FROM ilanlar WHERE 2";
}

// Filtreleri uygula
if (!empty($konum_filter)) {
    $sorgu .= " AND konum LIKE '%" . mysqli_real_escape_string($baglanti, $konum_filter) . "%'";
}
if (!empty($tur_filter)) {
    $sorgu .= " AND tur LIKE '%" . mysqli_real_escape_string($baglanti, $tur_filter) . "%'";
}
if (!empty($pozisyon_filter)) {
    $sorgu .= " AND pozisyon LIKE '%" . mysqli_real_escape_string($baglanti, $pozisyon_filter) . "%'";
}

// Tarihe göre sırala
$sorgu .= " ORDER BY tarih DESC";

$ilanlar = mysqli_query($baglanti, $sorgu);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>İş İlanları | Teknokariyer</title>
 
  <style>
  body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #ffffff;
  }

  header, footer  {
    background: #2e86de;
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
    color: #fff;
    text-decoration: none;
    font-weight: bold;
  }

  .jobs-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
  }

  .jobs-container h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #222;
    font-size: 2em;
  }

  .filter-form {
    text-align: center;
    margin-bottom: 30px;
  }

  .filter-form input,
  .filter-form button {
    padding: 10px;
    margin: 5px;
    border-radius: 6px;
    border: 1px solid #ccc;
  }

  .filter-form button {
    background-color: #2e86de;
    color: white;
    border: none;
    cursor: pointer;
  }

  .filter-form button:hover {
    background-color: #1b4f72;
  }

  .job-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 25px;
  }

  .job-card {
    background: linear-gradient(to right, #ffcc00, #ffb300);
    border: 1px solid #fbc02d;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
  }

  .job-card:hover {
    transform: scale(1.03);
    box-shadow: 0 10px 22px rgba(0, 0, 0, 0.2);
  }

  .job-card h3 {
    margin-top: 0;
    color: #000000;
  }

  .job-card p {
    color: #333;
    margin: 5px 0;
  }

  .job-card a {
    display: inline-block;
    margin-top: 12px;
    padding: 10px 16px;
    background-color: #000000;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.3s ease;
  }

  .job-card a:hover {
    background-color: #333333;
  }

  footer {
    margin-top: 60px;
    font-size: 14px;
  }
</style>

</head>
<body>

<header>
  <h1>Teknokariyer</h1>
  <nav>
    <ul>
      <li><a href="index.html">Ana Sayfa</a></li>
      <li><a href="profile.php">Profilim</a></li>
      <li><a href="logout.php">Çıkış Yap</a></li>
    </ul>
  </nav>
</header>

<main class="jobs-container">
  <h2>Yayındaki İlanlar</h2>

  <!-- Filtre Formu -->
  <form method="get" class="filter-form">
    <input type="text" name="konum" placeholder="Konum" value="<?php echo htmlspecialchars($konum_filter); ?>">
    <input type="text" name="tur" placeholder="Çalışma Türü (Tam Zamanlı, Staj vb.)" value="<?php echo htmlspecialchars($tur_filter); ?>">
    <input type="text" name="pozisyon" placeholder="Pozisyon" value="<?php echo htmlspecialchars($pozisyon_filter); ?>">
    <button type="submit">Filtrele</button>
  </form>

  <?php if (mysqli_num_rows($ilanlar) > 0): ?>
    <div class="job-grid">
      <?php while ($ilan = mysqli_fetch_assoc($ilanlar)): ?>
        <div class="job-card">
          <h3><?php echo htmlspecialchars($ilan['pozisyon']); ?></h3>
          <p><strong>Şirket:</strong> <?php echo htmlspecialchars($ilan['sirket']); ?></p>
          <p><strong>Konum:</strong> <?php echo htmlspecialchars($ilan['konum']); ?></p>
          <p><strong>Tür:</strong> <?php echo htmlspecialchars($ilan['tur']); ?></p>
          <a href="job_detail.php?id=<?php echo $ilan['id']; ?>">Detayları Gör</a>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <p style="text-align: center;">Uygun ilan bulunamadı.</p>
  <?php endif; ?>
</main>

<footer>
  <p>© 2025 Teknokariyer. Tüm hakları saklıdır.</p>
</footer>

</body>
</html>
