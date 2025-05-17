<?php
session_start();
include("baglanti.php");

// POST ile gelen giriş bilgilerini al
$email = $_POST['email'] ?? '';
$sifre = $_POST['password'] ?? '';

// Giriş formu POST ile gönderildiyse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Veritabanında e-postayı ara
    $sorgu = "SELECT * FROM kullanicilar WHERE email = '$email'";
    $sonuc = mysqli_query($baglanti, $sorgu);

    if (mysqli_num_rows($sonuc) == 1) {
        $kullanici = mysqli_fetch_assoc($sonuc);

        // Şifre doğrulaması
        if (password_verify($sifre, $kullanici['sifre'])) {
            // Oturum bilgilerini ayarla
            $_SESSION['kullanici_id'] = $kullanici['id'];
            $_SESSION['email'] = $kullanici['email'];
            $_SESSION['turu'] = $kullanici['kullanici_turu'];
            $_SESSION['adsoyad'] = $kullanici['adsoyad'];

            // Kullanıcı türüne göre yönlendir
            switch ($kullanici['kullanici_turu']) {
                case 'employer':
                    header("Location: employer_panel.php");
                    break;
                case 'student':
                case 'jobseeker':
                    header("Location: jobs.php");
                    break;
                default:
                    echo "Tanımsız kullanıcı türü.";
                    break;
            }
            exit;
        } else {
            $hata = "⚠️ Şifre hatalı.";
        }
    } else {
        $hata = "⚠️ Bu e-posta ile kayıtlı kullanıcı bulunamadı.";
    }

    mysqli_close($baglanti);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap | Teknokariyer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Teknokariyer</h1>
</header>

<main class="form-container">
    <h2>Giriş Yap</h2>

    <?php if (isset($hata)): ?>
        <p style="color:red;"><?php echo $hata; ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label for="email">E-posta:</label>
        <input type="email" id="email" name="email" required placeholder="ornek@mail.com">

        <label for="password">Şifre:</label>
        <input type="password" id="password" name="password" required placeholder="••••••••">

        <button type="submit">Giriş Yap</button>
    </form>

    <p>Hesabınız yok mu? <a href="register.html">Kayıt Ol</a></p>
</main>

<footer>
    <p>© 2025 Teknokariyer. Tüm hakları saklıdır.</p>
</footer>
</body>
</html>
