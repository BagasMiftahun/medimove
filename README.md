## Medimove

Medimove adalah website berbasis Laravel yang memfasilitasi pemindahan obat antar depo serta pencatatan stok obat untuk setiap depo.

### Fitur Utama

1. **Pemindahan Obat:**
   - Memungkinkan pengguna untuk melakukan pemindahan obat dari satu depo ke depo lain dengan mudah.
   - Menyediakan formulir untuk memasukkan detail obat yang dipindahkan, sumber depo, tujuan depo, dan jumlah yang dipindahkan.

2. **Manajemen Stok Obat:**
   - Pengguna dapat mengelola stok obat di setiap depo.
   - Menambah, mengurangi, dan memperbarui stok obat dengan mudah melalui antarmuka aplikasi.

3. **Manajemen Depo:**
   - Pengguna dapat mengatur informasi tentang depo, seperti nama, kode, dan detail lainnya.
   - Depo dapat ditambahkan, diperbarui, atau dihapus sesuai kebutuhan.

3. **Manajemen Obat:**
   - Pengguna dapat mengatur informasi tentang obat, seperti nama, harga, satuan dan detail lainnya.
   - Depo dapat ditambahkan, diperbarui, atau dihapus sesuai kebutuhan.

### Teknologi

- **Laravel 10:** Framework PHP yang kuat untuk pengembangan aplikasi web.
- **PHP 8.1:** Versi terbaru dari PHP dengan peningkatan kinerja dan fitur-fitur baru.
- **MySQL:** Database relasional untuk menyimpan data aplikasi.

### Instalasi

Untuk menjalankan aplikasi ini secara lokal, pastikan Anda telah menginstal:
- PHP 8.1 atau versi lebih tinggi
- Composer
- Laravel CLI
- Web Server localhost seperti Laragon atau Xampp

Ikuti langkah-langkah berikut:

1. **Clone repositori:**
   ```bash
   git clone https://github.com/namarepositori/medimove.git
   ```

2. **Instal dependencies:**
   ```bash
   cd medimove
   composer install
   ```

3. **Setel konfigurasi lingkungan:**
   - Duplikat file `.env.example` menjadi `.env` dan sesuaikan pengaturan database.
   - Generate kunci aplikasi Laravel:
     ```bash
     php artisan key:generate
     ```

4. **Migrasi database:**
   - Jalankan migrasi untuk membuat tabel yang diperlukan:
     ```bash
     php artisan migrate
     ```
5. **Import Data:**
   - Import data pada database untuk memasukkan data obat dan formasi yang diperlukan
   - Untuk data diimport berupa file bernama data.sql


5. **Jalankan server lokal:**
   ```bash
   php artisan serve
   ```

Aplikasi sekarang dapat diakses melalui browser di `http://localhost:8000`.

### Kontribusi

Silakan ajukan *pull request* jika Anda ingin berkontribusi pada proyek ini. Pastikan untuk membahas perubahan yang Anda ingin buat sebelumnya.

### Lisensi

Proyek ini dilisensikan di bawah lisensi [MIT](LICENSE).