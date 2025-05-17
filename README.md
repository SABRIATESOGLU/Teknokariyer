# 🧑‍💻 Teknokariyer

**Teknokariyer**, öğrenciler, mezunlar ve işverenler arasında dijital bir köprü kurmayı hedefleyen bir web tabanlı kariyer platformudur. Kullanıcılar sistemdeki rolleri doğrultusunda staj veya iş ilanları oluşturabilir, bu ilanlara başvuru yapabilir veya başvuruları yönetebilir.

---

## 📌 Proje Amacı

Bu proje, **Web Tasarımı ve Programlama** dersi kapsamında geliştirilmiş olup, kullanıcı yönetimi, ilan işlemleri, başvuru takip sistemi gibi temel web uygulama bileşenlerini içermektedir. Amaç, gerçek bir kariyer portalının işleyişini simüle ederek pratik bir deneyim sunmaktır.

---

## 🚀 Özellikler

### 👤 Kullanıcı Rolleri

1. **İşveren (Employer)**
   - İş ve staj ilanı oluşturabilir.
   - Başvuruları görebilir, onaylayabilir ya da reddedebilir.
   - Kendi ilanlarını listeleyebilir, düzenleyebilir ve silebilir.

2. **Öğrenci (Student)**
   - Sadece staj ilanlarını görüntüleyebilir.
   - Staj başvurusu yapabilir.
   - Mezun olduktan sonra "İş Arayan" rolüne geçiş yapabilir.

3. **İş Arayan (Jobseeker)**
   - Tüm iş ilanlarını filtreleyip görüntüleyebilir.
   - Başvuru yapabilir ve başvuru durumlarını takip edebilir.

---


---

## 🛠️ Teknolojiler

| Teknoloji     | Açıklama                                      |
|---------------|-----------------------------------------------|
| HTML5 / CSS3  | Arayüz tasarımı ve responsive yapı            |
| PHP           | Backend iş mantığı, session yönetimi          |
| MySQL         | Veritabanı işlemleri ve veri saklama          |
| XAMPP/Laragon | Geliştirme ortamı (localhost)                 |
| Markdown      | README yazımı için kullanılan işaretleme dili |

---

## 🧠 Uygulanan Mantıklar

- **Session tabanlı oturum kontrolü**
- **Rol bazlı yetkilendirme ve yönlendirme**
- **SQL ile veri çekme, filtreleme ve silme**
- **Dinamik filtreleme (konum, pozisyon, tür)**
- **Kullanıcıya özel içerik gösterimi**
- **Frontend için modern kart tabanlı UI**

---

## 🔒 Güvenlik ve Kontroller

- Yetkisiz erişim engelleme
- Sadece ilan sahibinin düzenleme/silme yetkisi
- JavaScript onay penceresi ile silme işlemi kontrolü
- Şifre güncelleme (opsiyonel)
- Hesap silme özelliği

---

## 📦 Kurulum ve Çalıştırma
Projeyi kendi bilgisayarınızda çalıştırmak için aşağıdaki adımları takip edebilirsiniz:

1. Depoyu klonlayın:
git clone https://github.com/kullaniciAdi/teknokariyer.git
2. Proje dizinine geçin:
cd teknokariyer
3. Veritabanı bağlantısını yapılandırın:
baglanti.php dosyasını açın ve kendi veritabanı bilgilerinizi girin:
$baglanti = mysqli_connect("localhost", "root", "", "teknokariyer");
4. Veritabanını oluşturun:
PhpMyAdmin ya da MySQL konsolu üzerinden veritabani.sql dosyasını içe aktarın.
5. Sunucuyu çalıştırın (XAMPP/WAMP):
XAMPP/WAMP’ı başlatın

Tarayıcıdan aşağıdaki adrese gidin:
http://localhost/teknokariyer/login.html




## Proje Görselleri

<p align="center">
  <img src="https://github.com/user-attachments/assets/a6b57d72-f38c-4ad4-9f98-738f1de43a59" width="45%" />
  <img src="https://github.com/user-attachments/assets/78a136f2-6989-4358-a080-8ebd4edc7daf" width="45%" />
</p>
<p align="center">
  <img src="https://github.com/user-attachments/assets/87f522fa-5000-496c-bf09-f06a85904765" width="45%" />
  <img src="https://github.com/user-attachments/assets/5fa134c5-2b99-4a78-9d8c-f45fcb1ad728" width="45%" />
</p>
<p align="center">
  <img src="https://github.com/user-attachments/assets/b927d0af-c6f3-41fa-88bc-57e026a634e4" width="45%" />
  <img src="https://github.com/user-attachments/assets/167e538d-0c8a-4910-b51c-fbb7f97dbe5d" width="45%" />
</p>
<p align="center">
  <img src="https://github.com/user-attachments/assets/35441161-6e47-432a-8702-f0cf74d423ef" width="45%" />
  <img src="https://github.com/user-attachments/assets/99656c54-8eaa-439c-9e87-7ec1a962b263" width="45%" />
</p>





