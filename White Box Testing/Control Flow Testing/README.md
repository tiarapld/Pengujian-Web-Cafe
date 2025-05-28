# Control Flow Testing - login.php (Cafe App)

## Tujuan
Mengidentifikasi dan menguji semua jalur logika login.php dalam Cafe App.

## Jalur Logika
1. `isset($_POST['login'])`
2. Cek jumlah baris hasil query (`$stmt->num_rows`)
3. `password_verify()`
4. `else` → password salah atau username tidak ditemukan

## Test Case
- Login sukses
- Username valid, password salah
- Username tidak ditemukan
- Form belum dikirim (tidak ada POST)

## Hasil
Semua jalur berhasil diuji menggunakan 4 skenario login.
