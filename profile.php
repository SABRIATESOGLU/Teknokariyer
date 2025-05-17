<?php
session_start();
include("baglanti.php");

if (!isset($_SESSION['email'])) {
  header("Location: login.html");
  exit;
}

$email = $_SESSION['email'];
$sorgu = "SELECT * FROM kullanicilar WHERE email = '$email'";
$sonuc = mysqli_query($baglanti, $sorgu);
$kullanici = mysqli_fetch_assoc($sonuc);
$turu = $kullanici['kullanici_turu'];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profilim | Teknokariyer</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #ffffff;
    }

    header, footer {
      background-color: #1a73e8;
      color: white;
      padding: 15px;
      text-align: center;
    }

    nav ul {
      list-style: none;
      padding: 0;
    }

    nav ul li {
      display: inline;
      margin: 0 10px;
    }

    nav a {
      color: white;
      text-decoration: none;
    }

    .form-container {
      max-width: 750px;
      margin: 30px auto;
      padding: 30px;
      background: #f4f4f4;
      border-radius: 16px;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    }

    h2, h3 {
      text-align: center;
      color: #222;
    }

    ul.panel-links {
      list-style: none;
      padding: 0;
      margin: 20px 0;
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    ul.panel-links li a {
      display: block;
      padding: 14px;
      background: linear-gradient(to right, #ffcc00, #ffb300);
      color: black;
      border-radius: 10px;
      text-align: center;
      font-weight: bold;
      text-decoration: none;
      transition: background 0.3s ease;
    }

    ul.panel-links li a:hover {
      background: linear-gradient(to right, #ffc107, #ffa000);
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 16px;
      margin-top: 20px;
    }

    label {
      font-weight: bold;
      color: #444;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    button {
      background: linear-gradient(to right, #ff512f, #dd2476);
      color: white;
      padding: 12px;
      border: none;
      border-radius: 10px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: linear-gradient(to right, #e63e2f, #c01464);
    }

    .convert-box {
      background: #fff3cd;
      padding: 16px;
      border-radius: 10px;
      margin-top: 20px;
      border: 1px solid #ffeeba;
    }

    .delete-button {
      background-color: #c0392b;
      margin-top: 10px;
    }

    hr {
      margin: 40px 0 30px;
      border: 0;
      border-top: 1px solid #ccc;
    }
  </style>
</head>
<body>
  <header>
    <h1>Teknokariyer</h1>
    <nav>
      <ul>
        <li><a href="index.html">Ana Sayfa</a></li>
      </ul>
    </nav>
  </header>

  <main class="form-container">
    <h2>Hoş Geldiniz, <?php echo htmlspecialchars($kullanici['adsoyad']); ?>!</h2>

    <?php if ($turu == 'employer'): ?>
      <h3>İşveren Paneli</h3>
      <ul class="panel-links">
        <li><a href="employer_panel.php">Yeni İlan Yayınla</a></li>
        <li><a href="employer_applications.php">Gelen Başvuruları Görüntüle</a></li>
        <li><a href="my_jobs.php">İlanlarım</a></li>
      </ul>

    <?php elseif ($turu == 'jobseeker'): ?>
      <h3>İş Arayan Paneli</h3>
      <ul class="panel-links">
        <li><a href="jobs.php">İlanlara Göz At</a></li>
        <li><a href="my_applications.php">Başvurularımı Görüntüle</a></li>
      </ul>

    <?php elseif ($turu == 'student'): ?>
      <h3>Öğrenci Paneli</h3>
      <ul class="panel-links">
        <li><a href="jobs.php?type=staj">Staj İlanlarına Göz At</a></li>
        <li><a href="my_applications.php">Staj Başvurularımı Görüntüle</a></li>
      </ul>
      <div class="convert-box">
        <form action="convert_user_type.php" method="POST">
          <input type="hidden" name="email" value="<?php echo htmlspecialchars($kullanici['email']); ?>">
          <button type="submit" onclick="return confirm('Bu işlemi yaptıktan sonra öğrenci paneline erişiminiz kalmayacak. Devam edilsin mi?');">
            Mezun oldum, iş aramak istiyorum
          </button>
        </form>
      </div>
    <?php endif; ?>

    <hr>

    <h3>Profil Bilgilerim</h3>
    <form action="profile_update.php" method="POST">
      <label for="fullname">Ad Soyad:</label>
      <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($kullanici['adsoyad']); ?>" required>

      <label for="email">E-posta (değiştirilemez):</label>
      <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($kullanici['email']); ?>" readonly>

      <label for="password">Yeni Şifre (isteğe bağlı):</label>
      <input type="password" id="password" name="password">

      <button type="submit">Güncelle</button>
    </form>

    <!-- Hesap Silme Formu -->
    <form action="delete_account.php" method="POST" onsubmit="return confirm('Hesabınızı silmek istediğinize emin misiniz? Bu işlem geri alınamaz.');">
      <input type="hidden" name="email" value="<?php echo htmlspecialchars($kullanici['email']); ?>">
      <button type="submit" class="delete-button">Hesabımı Sil</button>
    </form>

  </main>

  <footer>
    <p>© 2025 Teknokariyer. Tüm hakları saklıdır.</p>
  </footer>
</body>
</html>
