# Absensi Online V2.0

![1](https://github.com/ICWR-TEAM/absensi-online/assets/45759837/69821cba-46f8-4a86-b7a8-c715f9eba506)

Aplikasi Absensi Online dibangun menggunakan framework PHP Laravel, memberikan solusi modern untuk manajemen absensi karyawan atau siswa secara efisien. Aplikasi ini dirancang dengan antarmuka pengguna yang bersih dan responsif untuk memastikan pengalaman pengguna yang optimal.

### Apa yang update?
    1. Penambahan webcam
    2. Tutup atau buka otomatis
    3. Penguatan security(captcha, csrf, dsb)
    4. Website yang responsive
    5. Dsb

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

### Lain-lain

[![Powered](https://skillicons.dev/icons?i=php,mysql,js,html,css,bootstrap,laravel)](https://skillicons.dev)
<br>
![visitor badge](https://visitor-badge.laobi.icu/badge?page_id=ICWR-TEAM.absensi-online&left_text=My%20Page%20Visitors)
![292222072-1c0ace01-95e0-4bcd-a7ce-b5e2765084e5](https://github.com/ICWR-TEAM/absensi-online/assets/45759837/6f9e9fb1-3df6-4dca-9f47-56669efb0074)


### Gambar lain

![10](https://github.com/ICWR-TEAM/absensi-online/assets/45759837/f18456a8-029d-4312-95a1-98fc11205f8e)
![9](https://github.com/ICWR-TEAM/absensi-online/assets/45759837/384c3862-f714-4594-add5-978fd8fc1d87)
![8](https://github.com/ICWR-TEAM/absensi-online/assets/45759837/98954194-3b35-482d-b67c-67273cff9ba7)
![7](https://github.com/ICWR-TEAM/absensi-online/assets/45759837/20f2b1bf-0421-4320-a782-d0a5f84ba72c)
![6](https://github.com/ICWR-TEAM/absensi-online/assets/45759837/4c2e9ff1-e1a7-4ea9-91be-124525b3a1f4)
![5](https://github.com/ICWR-TEAM/absensi-online/assets/45759837/e5b059d2-9311-44fc-b15e-474608948ff9)
![4](https://github.com/ICWR-TEAM/absensi-online/assets/45759837/ec2f59d6-aaf6-411b-8b12-effe027ca2fd)
![3](https://github.com/ICWR-TEAM/absensi-online/assets/45759837/11022f7d-fc23-4f60-ba41-4c29dc7f237b)
![2](https://github.com/ICWR-TEAM/absensi-online/assets/45759837/457eb2e2-8c35-4bfc-83c3-13550669884e)
