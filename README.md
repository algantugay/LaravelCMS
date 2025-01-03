# Laravel CMS Projesi

Bu proje, Laravel 11 kullanarak geliştirilmiş bir içerik yönetim sistemidir (CMS). Kullanıcı yönetimi, sayfa yönetimi, kategori yönetimi, yorumlar ve mesajlar gibi temel CMS işlevlerini içermektedir. Ayrıca admin paneli ve kullanıcı arayüzü bulunur.

## Özellikler

- **Kullanıcı Yönetimi:** Kullanıcılar oluşturulabilir, düzenlenebilir ve silinebilir.
- **Admin Paneli:** Admin kullanıcıları için özel bir yönetim paneli.
- **Sayfa Yönetimi:** Dinamik olarak sayfalar oluşturulabilir ve düzenlenebilir.
- **Kategori Yönetimi:** Sayfalar kategorilere ayrılabilir.
- **Yorumlar:** Kullanıcılar sayfalara yorum yapabilir, yorumlar yönetilebilir.
- **Mesajlar:** Kullanıcılar admin'e mesaj gönderebilir.
- **Roller:** Admin ve kullanıcı olmak üzere iki farklı rol sistemi bulunur.

## Gereksinimler

- PHP 8.1 veya daha yeni bir sürüm
- Composer
- MySQL veya benzeri bir veritabanı yönetim sistemi

## Kurulum Adımları

 **1. Projenin İndirilmesi:**

    GitHub reposunu klonlayın:

    ```bash
    git clone https://github.com/algantugay/LaravelCMS.git
    ```

 **2. Bağımlılıkların Yüklenmesi:**

    Laravel projesi için gerekli olan tüm bağımlılıkları yüklemek için aşağıdaki komutu çalıştırın:

    ```bash
    composer intstall
    ```

 **3. .env Dosyasının Ayarlanması:**

    .env dosyasını oluşturun (eğer yoksa) ve aşağıdaki komutu kullanarak örnek dosyayı kopyalayın:

    ```bash
    cp .env.example .env
    ```

    .env dosyasındaki veritabanı bağlantı bilgilerini düzenleyin:

    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

 **4. Veritabanı Migrasyonlarının Çalıştırılması:**

    Veritabanı tablolarını oluşturmak için migrasyonları çalıştırın:

    ```bash
    php artisan migrate
    ```

 **5. Uygulama Anahtarının Ayarlanması:**

    Laravel uygulama anahtarını ayarlayın:

    ```bash
    php artisan key:generate
    ```

 **6. Veritabanı Seed'lerinin Çalıştırılması:**

    Varsayılan kullanıcılar ve içerikler için seed'leri çalıştırabilirsiniz:

    ```bash
    php artisan db:seed
    ```

 **7. Geliştirme Sunucusunun Başlatılması:**

    Uygulamayı yerel ortamda çalıştırmak için aşağıdaki komutu kullanın:

    ```bash
    php artisan serve
    ```

--------------------------------------------------------------------------

## Admin Girişi

Admin paneline giriş yapmak için:
* **Kullanıcı adı:** admin
* **Şifre:** admin123

## Özellikler

### Kullanıcılar
* Admin, kullanıcıları yönetebilir (düzenleme, silme).
* Admin, her kullanıcının rollerini belirleyebilir (admin, user).

### Sayfalar
* Admin, sayfalar oluşturabilir, düzenleyebilir ve silebilir.
* Sayfalar kategorilere ayrılabilir.

### Yorumlar
* Kullanıcılar yorum yapabilir.
* Admin, yorumların durumunu (taslak, yayınlanmış, reddedilmiş) güncelleyebilir.

### Mesajlar
* Kullanıcılar admin'e mesaj gönderebilir.
* Admin, gelen mesajları görebilir ve cevaplayabilir.

### Lisans
Bu proje [MIT lisansı](https://opensource.org/license/MIT) altında lisanslanmış açık kaynaklı bir yazılımdır.