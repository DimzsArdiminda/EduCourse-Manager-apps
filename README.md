

---

# **Dokumentasi Aplikasi**

## **Tech Stack**
- **Framework Backend**: Laravel
- **Frontend Styling**: Tailwind CSS (dengan Vite)
- **Database**: MySQL

---

## **Cara Menjalankan Aplikasi**

### **1. Instalasi dan Konfigurasi**
1. **Instalasi Dependency**  
   Jalankan perintah berikut untuk menginstal seluruh dependency aplikasi:  
   ```bash
   npm install
   composer install
   ```

2. **Konfigurasi Database**  
   - Buka file `.env` pada root directory proyek.
   - Sesuaikan konfigurasi database (DB_DATABASE, DB_USERNAME, DB_PASSWORD) sesuai dengan environment lokal Anda.

3. **Migrasi Database**  
   Jalankan perintah berikut untuk membuat struktur database:  
   ```bash
   php artisan migrate
   ```

4. **Seeder Database**  
   Untuk menambahkan data awal pada database, jalankan:  
   ```bash
   php artisan db:seed
   ```

### **2. Menjalankan Aplikasi**
1. **Memulai Server Laravel**  
   Jalankan server lokal dengan perintah:  
   ```bash
   php artisan serve
   ```

2. **Memulai Proses Build Vite (CSS & JS)**  
   Buka terminal baru dan jalankan:  
   ```bash
   npm run dev
   ```

3. **Akses Aplikasi**  
   Setelah proses di atas, aplikasi dapat diakses melalui browser di:  
   ```
   http://127.0.0.1:8000
   ```

---

## **Fitur Import Database**
- Fitur ini mendukung proses import data dalam format file **Excel**.
- Contoh file yang dapat digunakan untuk import tersedia dengan nama **`upload data.xlsx`** di dalam folder root aplikasi.

---

## **Open API**
Aplikasi ini menyediakan **Open API** untuk pengembangan lebih lanjut. Berikut adalah daftar endpoint API yang tersedia:  

### **Siswa API**
1. **GET** - List Semua Data Siswa  
   ```
   http://127.0.0.1:8000/api/siswa
   ```

2. **GET** - Ambil Data Siswa Berdasarkan ID  
   ```
   http://127.0.0.1:8000/api/siswa/{id}
   ```

3. **POST** - Tambah Data Siswa  
   ```
   http://127.0.0.1:8000/api/siswa
   ```

4. **PUT** - Update Data Siswa Berdasarkan ID  
   ```
   http://127.0.0.1:8000/api/siswa/{id}
   ```

5. **DELETE** - Hapus Data Siswa Berdasarkan ID  
   ```
   http://127.0.0.1:8000/api/siswa/{id}
   ```

### **Course API**
6. **GET** - List Semua Data Course  
   ```
   http://127.0.0.1:8000/api/courses
   ```

7. **GET** - Ambil Data Course Berdasarkan ID  
   ```
   http://127.0.0.1:8000/api/courses/{id}
   ```

8. **POST** - Tambah Data Course  
   ```
   http://127.0.0.1:8000/api/courses
   ```

9. **PUT** - Update Data Course Berdasarkan ID  
   ```
   http://127.0.0.1:8000/api/courses/{id}
   ```

10. **DELETE** - Hapus Data Course Berdasarkan ID  
    ```
    http://127.0.0.1:8000/api/courses/{id}
    ```

---

## **Contoh Request API**
Untuk mempermudah pengujian, file contoh permintaan API tersedia dengan nama **`req.rest`** di root folder aplikasi. File ini dapat digunakan bersama ekstensi **REST Client** di Visual Studio Code.  

---

### **Catatan**
- Pastikan **server Laravel** sudah berjalan di alamat: `http://127.0.0.1:8000`.
- Jika ada perubahan URL atau port, sesuaikan endpoint API sesuai dengan konfigurasi server Anda.  

--- 