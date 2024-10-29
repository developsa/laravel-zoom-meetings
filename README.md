# Zoom API Kullanarak Laravel Projesi

Bu proje, Zoom API kullanarak kullanıcıların toplantı oluşturma işlemlerini gerçekleştirmelerine olanak tanır. Kullanıcılar sistemde hesap oluşturarak, Zoom üzerinde toplantı ayarlayabilirler. Oluşturulan toplantılar, katılımcılara bildirim olarak iletilir, böylece herkes toplantı hakkında bilgi sahibi olur.

Ayrıca, kullanıcılar "Şifremi Unuttum" seçeneği ile e-posta adreslerine yeni şifre talep edebilirler. Bu özellik, kullanıcıların hesaplarına kolayca erişim sağlamalarına yardımcı olur.

## Özellikler

- Kullanıcı Girişi
- Toplantı Oluşturma, Düzenleme ve Silme
- Şifre Unutma ve E-posta ile Şifre Gönderimi
- Bildirim Sistemi (Toplantı Oluşturucu ve Katılımcılar için)

## Gereksinimler

- PHP >= 7.3
- Composer
- Laravel >= 8.x
- MySQL veya diğer desteklenen veritabanları
- Zoom API Erişim Anahtarı

## Kurulum

1. **Repo'yu Klonlayın**
   ```bash
   git clone https://github.com/kullanici_adiniz/proje_adi.git
2. **Proje Klasörüne Geçin**
   ```bash
   cd ZOOM-PROJECT
3. **Gerekli Paketleri Yükleyin**
   ```bash
   composer install
4. **Çevresel Değişkenleri Ayarlayın**
   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=veritabani_adi
    DB_USERNAME=kullanici_adi
    DB_PASSWORD=sifre

   ZOOM_CLIENT_ID=zoom_client_id
   ZOOM_CLIENT_SECRET=zoom_client_sirresi
   ZOOM_ACCOUNT_ID=zoom_account_id
   ZOOM_CACHE_TOKEN=true
5. **Veritabanı Migrate Edin**
   ```bash
   php artisan migrate
6. **Sunucuyu Başlatın**
   ```bash
   php artisan serve
