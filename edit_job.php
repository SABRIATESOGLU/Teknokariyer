<?php
session_start();
include("baglanti.php");

if (!isset($_SESSION['kullanici_id']) || $_SESSION['turu'] != 'employer') {
    header("Location: login.html");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];

// Form gönderildiyse güncelle
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $pozisyon = $_POST['job_title'];
    $sirket = $_POST['company'];
    $konum = $_POST['location'];
    $tur = $_POST['type'];
    $aciklama = $_POST['description'];

    // Güncelleme sorgusu
    $guncelle = "UPDATE ilanlar SET 
                  pozisyon = '$pozisyon', 
                  sirket = '$sirket', 
                  konum = '$konum', 
                  tur = '$tur', 
                  aciklama = '$aciklama' 
                 WHERE id = '$id' AND kullanici_id = '$kullanici_id'";

    if (mysqli_query($baglanti, $guncelle)) {
        echo "<script>alert('İlan başarıyla güncellendi.'); window.location.href='my_jobs.php';</script>";
        exit;
    } else {
        echo "Hata: " . mysqli_error($baglanti);
    }
}

// GET ile sayfa açılmışsa düzenlenecek ilanı göster
$ilan_id = $_GET['id'] ?? null;

if (!$ilan_id) {
    echo "Geçersiz ilan ID.";
    exit;
}

// Bu ilana sadece kendi ilanıysa erişebilsin
$sorgu = "SELECT * FROM ilanlar WHERE id = '$ilan_id' AND kullanici_id = '$kullanici_id'";
$sonuc = mysqli_query($baglanti, $sorgu);
$ilan = mysqli_fetch_assoc($sonuc);

if (!$ilan) {
    echo "Bu ilana erişim yetkiniz yok.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>İlan Güncelle | Teknokariyer</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f9;
}

header, footer {
    background: #2e86de; /* Üst kısmın rengini aynı tutuyoruz */
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

input[type="text"], select, textarea {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #fff176;
    font-size: 16px;
    box-sizing: border-box;
    background-color: #fffde7; /* Soluk sarı arka plan */
}

textarea {
    resize: vertical;
}

button {
    margin-top: 20px;
    width: 100%;
    padding: 12px;
    background-color: #000000; /* Siyah buton */
    color: #fff;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #333; /* Hover rengi */
}

footer {
    margin-top: 60px;
    font-size: 14px;
}

footer p {
    color: #333;
}

@media (max-width: 768px) {
    .form-container {
        padding: 20px;
        margin: 20px;
    }

    form label, form input, form select, form textarea {
        font-size: 14px;
    }

    form button {
        font-size: 16px;
    }
}

        
    </style>
</head>
<body>
<header>
    <h1>Teknokariyer</h1>
</header>

<main class="form-container">
    <h2>İlanı Güncelle</h2>

    <form action="edit_job.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $ilan['id']; ?>">

        <label for="job_title">Pozisyon:</label>
        <input type="text" id="job_title" name="job_title" value="<?php echo htmlspecialchars($ilan['pozisyon']); ?>" required>

        <label for="company">Şirket:</label>
        <input type="text" id="company" name="company" value="<?php echo htmlspecialchars($ilan['sirket']); ?>" required>

        <label for="location">Konum:</label>
        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($ilan['konum']); ?>" required>

        <label for="type">Çalışma Türü:</label>
        <select id="type" name="type" required>
            <option value="">Seçiniz</option>
            <option value="Tam Zamanlı" <?php if ($ilan['tur'] == 'Tam Zamanlı') echo 'selected'; ?>>Tam Zamanlı</option>
            <option value="Yarı Zamanlı" <?php if ($ilan['tur'] == 'Yarı Zamanlı') echo 'selected'; ?>>Yarı Zamanlı</option>
            <option value="Staj" <?php if ($ilan['tur'] == 'Staj') echo 'selected'; ?>>Staj</option>
            <option value="Uzaktan" <?php if ($ilan['tur'] == 'Uzaktan') echo 'selected'; ?>>Uzaktan</option>
        </select>

        <label for="description">İlan Açıklaması:</label>
        <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($ilan['aciklama']); ?></textarea>

        <button type="submit">Güncelle</button>
    </form>
</main>

<footer>
    <p>© 2025 Teknokariyer. Tüm hakları saklıdır.</p>
</footer>
</body>
</html>
