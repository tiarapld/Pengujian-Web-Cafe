
# Data Flow Testing - login.php (Cafe App)

## Tujuan
Menelusuri alur data penting pada proses login sistem Cafe App.

## Variabel Kunci
- `$username`, `$password`: data input dari user
- `$hashed_password`: hash password dari database
- `$stmt`: hasil query SELECT
- `$_SESSION['user_id']`: menyimpan sesi user login

## Uji Alur
- Input divalidasi dan digunakan pada query
- Password diverifikasi dengan benar
- Session diset saat login berhasil
- Penanganan error dilakukan jika login gagal

## Hasil
Tidak ada kesalahan dalam penggunaan dan alur data login.php Cafe App.

