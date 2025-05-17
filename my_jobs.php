<?php
session_start();
include("baglanti.php");

if (!isset($_SESSION['kullanici_id']) || $_SESSION['turu'] != 'employer') {
    header("Location: login.html");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];

// Silme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $sil_ilan_id = $_POST['id'];

    $kontrol = mysqli_query($baglanti, "SELECT * FROM ilanlar WHERE id = '$sil_ilan_id' AND kullanici_id = '$kullanici_id'");
    if (mysqli_num_rows($kontrol) > 0) {
        mysqli_query($baglanti, "DELETE FROM ilanlar WHERE id = '$sil_ilan_id'");
        mysqli_query($baglanti, "DELETE FROM basvurular WHERE ilan_id = '$sil_ilan_id'");
        echo "<script>alert('İlan başarıyla silindi.');</script>";
    } else {
        echo "<script>alert('Bu ilana erişiminiz yok.');</script>";
    }
}

// İlanları getir
$sorgu = "SELECT * FROM ilanlar WHERE kullanici_id = '$kullanici_id' ORDER BY tarih DESC";
$ilanlar = mysqli_query($baglanti, $sorgu);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yayınladığım İlanlar | Teknokariyer</title>
    <link rel="stylesheet" href="style.css">
    <style>
  body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #ffffff;
  }

  header, footer {
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

  .form-container {
    max-width: 900px;
    margin: 50px auto;
    background: linear-gradient(to right, #ffcc00, #ffb300);
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    border: 2px solid #ffb300;
    color: #333;
  }

  .form-container h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #000;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fffde7;
    border: 1px solid #fbc02d;
  }

  th, td {
    text-align: center;
    padding: 10px;
    border: 1px solid #fbc02d;
  }

  th {
    background-color: #fff176;
    color: #333;
  }

  td {
    background-color: #fffde7;
  }

  button {
    padding: 6px 12px;
    background-color: #000000;
    color: #ffffff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease;
  }

  button:hover {
    background-color: #333;
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
            <li><a href="employer_panel.php">Yeni İlan Yayınla</a></li>
            <li><a href="profile.php">Profilim</a></li>
            <li><a href="logout.php">Çıkış Yap</a></li>
        </ul>
    </nav>
</header>

<main class="form-container">
    <h2>Yayınladığım İlanlar</h2>

    <?php if (mysqli_num_rows($ilanlar) > 0): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Pozisyon</th>
                <th>Şirket</th>
                <th>Konum</th>
                <th>Tür</th>
                <th>Tarih</th>
                <th>Başvuru Sayısı</th>
                <th>İşlemler</th>
            </tr>
            <?php while ($ilan = mysqli_fetch_assoc($ilanlar)): ?>
                <?php
                $ilan_id = $ilan['id'];
                $basvuru_sorgu = mysqli_query($baglanti, "SELECT COUNT(*) AS sayi FROM basvurular WHERE ilan_id = '$ilan_id'");
                $basvuru_sayisi = mysqli_fetch_assoc($basvuru_sorgu)['sayi'];
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($ilan['pozisyon']); ?></td>
                    <td><?php echo htmlspecialchars($ilan['sirket']); ?></td>
                    <td><?php echo htmlspecialchars($ilan['konum']); ?></td>
                    <td><?php echo htmlspecialchars($ilan['tur']); ?></td>
                    <td><?php echo $ilan['tarih']; ?></td>
                    <td><?php echo $basvuru_sayisi; ?></td>
                    <td>
                        <form action="edit_job.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $ilan_id; ?>">
                            <button type="submit">Güncelle</button>
                        </form>
                        <form method="POST" onsubmit="return confirm('Bu ilanı silmek istediğinizden emin misiniz?');" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $ilan_id; ?>">
                            <button type="submit">Sil</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Henüz ilan yayınlamadınız.</p>
    <?php endif; ?>
</main>

<footer>
    <p>© 2025 Teknokariyer. Tüm hakları saklıdır.</p>
</footer>
</body>
</html>
