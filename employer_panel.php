<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['turu'] != 'employer') {
  header("Location: login.html");
  exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>İşveren Paneli | Teknokariyer</title>
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
  max-width: 700px;
  margin: 50px auto;
  background: linear-gradient(to right, #ffcc00, #ffb300); /* Sarı geçişli arka plan */
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

    label {
      display: block;
      margin-top: 15px;
      margin-bottom: 5px;
      font-weight: bold;
      color: #333;
    }
    input[type="text"],
select,
textarea {
  width: 100%;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #fff176;
  font-size: 16px;
  box-sizing: border-box;
  background-color: #fffde7;
}

    textarea {
      resize: vertical;
    }
    button {
  margin-top: 20px;
  width: 100%;
  padding: 12px;
  background-color: #000000;
  color: #fff;
  border: none;
  border-radius: 8px;
  font-weight: bold;
  font-size: 16px;
  cursor: pointer;
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
        <li><a href="index.html">Ana Sayfa</a></li>
        <li><a href="jobs.php">İlanlar</a></li>
        <li><a href="profile.php">Profilim</a></li>
        <li><a href="logout.php">Çıkış Yap</a></li>
      </ul>
    </nav>
  </header>

  <main class="form-container">
    <h2>İş İlanı Ekle</h2>
    <form action="add_job.php" method="POST">
      <label for="job_title">Pozisyon:</label>
      <input type="text" id="job_title" name="job_title" required>

      <label for="company">Şirket Adı:</label>
      <input type="text" id="company" name="company" required>

      <label for="location">Konum:</label>
      <input type="text" id="location" name="location" required>

      <label for="type">Çalışma Türü:</label>
      <select id="type" name="type" required>
        <option value="">Seçiniz</option>
        <option value="Tam Zamanlı">Tam Zamanlı</option>
        <option value="Yarı Zamanlı">Yarı Zamanlı</option>
        <option value="Staj">Staj</option>
        <option value="Uzaktan">Uzaktan</option>
      </select>

      <label for="description">İlan Açıklaması:</label>
      <textarea id="description" name="description" rows="5" required></textarea>

      <button type="submit">İlanı Yayınla</button>
    </form>
  </main>

  <footer>
    <p>© 2025 Teknokariyer. Tüm hakları saklıdır.</p>
  </footer>
</body>
</html>
