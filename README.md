# absensi-online
![Foto](https://raw.githubusercontent.com/Jon3sjns/upload_foto/main/absensi_online/1.png)
Aplikasi Absensi Online dibangun menggunakan framework PHP Laravel, memberikan solusi modern untuk manajemen absensi karyawan secara efisien. Aplikasi ini dirancang dengan antarmuka pengguna yang bersih dan responsif untuk memastikan pengalaman pengguna yang optimal.

### Apa yang update?
    1. Penambahan webcam
    2. Tutup atau buka otomatis
    3. Penguatan security(captcha, csrf, dsb)

### Apa yang dibutuhkan?
    1. PHP Server
    2. MYSql database
    3. Koneksi internet
    4. Dsb

### Cara penggunaan
    1. Unduh repository ini
    2. Jalankan "composer install"
    3. Jalankan "cp .env.example .env"
    4. Jalankan "php artisan key:generate"
    5. Jalankan "php artisan migrate:fresh"
    6. Jalankan "php artisan db:seed --class=CreateUserAdmin"
    7. Jalankan "php artisan db:seed --class=SettingAbsensi"
    8. Setting .env file (Sub judul selanjutnya)
    9. Selanjutnya file setting file .env di bawah ini

### Cara setting file .env
    1. APP_DEBUG=false
    2. APP_URL=https://sesuaikan_url_anda.com *disarankan / http://sesuaikan_url_anda.com
    3. Tambahkan FORCE_HTTPS=true(jika menggunakan protokol https *disarankan) / false(jika menggunakan protokol http)
    4. DB_HOST=host_mysql
    5. DB_PORT=3306 / sesuaikan port mysql anda
    6. DB_DATABASE=absensi_online / sesuaikan nama database anda
    7. DB_USERNAME=icwr / sesuaikan username database anda
    8. DB_PASSWORD=icwr / sesuaikan password database anda
    9. APP_ENV=local / production / testing (sesuaikan dengan lingkungan anda)

### Default akun
    Email: icwr@icwr.com
    Password: icwr

### Hal yang harus diperhatikan
    1. Harus menggunakan https demi kelancaran library webcam
    2. Ubah username dan password default dengan cara
        tambahkan user pada dashboard admin dan hapus
        user icwr (demi keamanan website anda)

### Komponen
- Laravel
- Bootstrap
- Jquery
- Datables
- Chart.js
- Webcam.js
- Dashboard admin [Reza-Admin](https://github.com/rezafikkri/Reza-Admin)

###
