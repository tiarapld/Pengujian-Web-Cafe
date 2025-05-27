**DEFINISI PARAMETER DAN KONDISI – GRAY-BOX TESTING**

| No | Fitur yang Diuji   | Parameter Pengujian (Gray-box)                                                                | Tujuan Pengujian                                                      |
| -- | ------------------ | --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------- |
| 1  | Login / Registrasi | - Input username dan password terstruktur<br>- Validasi input dari UI & backend               | Memastikan proses registrasi dan login sukses serta input tervalidasi |
| 2  | Halaman Dashboard  | - Menampilkan ucapan selamat datang<br>- Validasi adanya navbar (Home, Menu, Tentang, Kontak) | Memastikan elemen navigasi dan UI tampil sesuai dan responsif         |
| 3  | Halaman Menu       | - Validasi daftar produk tampil dari database<br>- Sinkronisasi data frontend-backend         | Menjamin konsistensi tampilan data produk di UI                       |
| 4  | Pemesanan Produk   | - Pemrosesan tombol “Pesan” bekerja<br>- Produk ditambahkan ke daftar pesanan                 | Memastikan alur pemesanan berjalan normal dan benar                   |
| 5  | Checkout Pemesanan | - Simulasi transaksi final<br>- Validasi total harga, item, dan data pembayaran               | Memastikan transaksi tercatat dan informasi checkout akurat           |
| 6  | Form Pemesanan     | - Input data nama, alamat, kontak, metode pembayaran<br>- Validasi & penyimpanan data         | Memastikan data form tervalidasi, lengkap, dan aman disimpan          |
| 7  | Keamanan Session   | - Validasi session timeout dan logout<br>- Uji session hijacking                              | Menjamin akses pengguna tetap aman dan tidak bocor                    |
| 8  | Error Handling     | - Simulasi kesalahan (DB down, koneksi gagal, dll)<br>- Validasi pesan error & logging        | Menjamin informasi error ditangani dengan aman dan dapat ditelusuri   |
| 9  | Logging Aktivitas  | - Validasi pencatatan login, transaksi, dan aktivitas lainnya ke server log                   | Memastikan adanya jejak audit untuk debugging dan investigasi         |

**TABEL PENGUJIAN GRAY-BOX – WEBSITE CAFE AROMA**

| No | Test Case ID     | Modul/Fitur        | Input Data                                                    | Expected Output                                     | Actual Output                   | Status (Pass/Fail) | Notes                                   |
| -- | ---------------- | ------------------ | ------------------------------------------------------------- | --------------------------------------------------- | ------------------------------- | ------------------ | --------------------------------------- |
| 1  | TC-GB-CKOUT-001  | Checkout           | Lanjutkan pemesanan produk yang telah dipilih                 | Transaksi tercatat, muncul detail pesanan dan total | Detail tidak muncul             | **Fail**           | Validasi akhir transaksi tidak berhasil |
| 2  | TC-GB-DASH-001   | Halaman Dashboard  | Akses setelah login                                           | Tampilkan ucapan selamat datang & navbar lengkap    | Navbar dan ucapan muncul        | **Pass**           | Dashboard sesuai dengan peran user      |
| 3  | TC-GB-FORM-001   | Form Pemesanan     | Isi form: nama, alamat, no HP, metode pembayaran              | Data tervalidasi dan tersimpan                      | Semua data tampil dan tersimpan | **Pass**           | Input pemesanan berhasil dan aman       |
| 4  | TC-GB-LOG-001    | Login              | Username & password tidak terdaftar                           | Error: "Akun tidak ditemukan"                       | Login gagal                     | **Pass**           | Validasi login berfungsi                |
| 5  | TC-GB-LOG-002    | Login              | Username/email/password valid dan terdaftar                   | Login berhasil                                      | Login berhasil                  | **Pass**           | Autentikasi sesuai akun valid           |
| 6  | TC-GB-LOG-003    | Login              | Username/email valid, password terlalu panjang (>20 karakter) | Login ditolak karena panjang karakter               | Login diterima                  | **Fail**           | Validasi panjang password belum ada     |
| 7  | TC-GB-LOGREG-001 | Login / Registrasi | Input username dan password valid dan terstruktur             | Registrasi/login berhasil                           | Login diterima                  | **Pass**           | Validasi input & autentikasi sukses     |
| 8  | TC-GB-MENU-001   | Halaman Menu       | Akses halaman Menu                                            | Menampilkan daftar produk yang tersedia             | Produk tampil sesuai            | **Pass**           | Validasi data produk tampil di UI       |
| 9  | TC-GB-ORDER-001  | Pemesanan Produk   | Klik tombol "Pesan" pada produk dari halaman Menu             | Produk masuk ke daftar pesanan atau keranjang       | Produk tidak masuk              | **Fail**           | Alur pemesanan belum bekerja            |
| 10 | TC-GB-REG-001    | Registrasi         | Username acak (`!@#user123`)                                  | Username tidak diterima (invalid character)         | Username diterima               | **Fail**           | Validasi karakter username longgar      |
| 11 | TC-GB-REG-002    | Registrasi         | Email acak valid (`abc123@gmail.com`)                         | Email diterima                                      | Email diterima                  | **Pass**           | Validasi email berhasil                 |
| 12 | TC-GB-REG-003    | Registrasi         | Password panjang > 20 karakter (`passwordpanjangsekali123`)   | Password ditolak                                    | Password diterima               | **Fail**           | Tidak ada batasan panjang password      |
| 13 | TC-GB-REG-004    | Registrasi         | Username/email/password sudah terdaftar sebelumnya            | Registrasi ditolak, muncul pesan error              | Registrasi ditolak              | **Pass**           | Duplikasi data ditolak dengan baik      |

**UJI MENJALANKAN TEST CASE PADA WEBSITE**

Setelah menyusun daftar test case, pengujian dilakukan secara langsung pada website CAFE AROMA untuk memverifikasi apakah fungsionalitas berjalan sesuai dengan ekspektasi yang telah ditentukan. Pengujian dilakukan menggunakan metode Gray-Box, yaitu dengan menggabungkan pengetahuan terhadap struktur internal sistem (misalnya database, validasi backend) dan antarmuka pengguna (frontend). Berikut adalah langkah-langkah dan hasil uji test case:

1. Login / Registrasi
Langkah Uji: Melakukan input data registrasi dengan kombinasi input valid dan tidak valid, serta mencoba login menggunakan akun yang sudah terdaftar dan tidak terdaftar.

Hasil:

Beberapa input tidak tervalidasi dengan baik (misalnya karakter khusus pada username dan panjang password tidak dibatasi).

Login dengan data yang valid berhasil.

Status: Sebagian Pass, Sebagian Fail

2. Halaman Dashboard
Langkah Uji: Melakukan login dan mengamati halaman dashboard yang muncul.

Hasil:

Tampil ucapan selamat datang dan elemen navigasi (navbar) lengkap.

Status: Pass

3. Halaman Menu
Langkah Uji: Mengakses halaman menu dari navbar dan memeriksa apakah produk tampil.

Hasil:

Semua produk tampil sesuai data yang ada di backend.

Status: Pass

4. Pemesanan Produk
Langkah Uji: Menekan tombol "Pesan" pada produk yang ingin dibeli.

Hasil:

Beberapa kali tombol tidak memberikan efek, produk tidak masuk ke daftar pesanan.

Status: Fail

5. Checkout
Langkah Uji: Melanjutkan ke proses checkout setelah memilih produk.

Hasil:

Halaman checkout tidak menampilkan detail pesanan secara lengkap.

Status: Fail

6. Form Pemesanan
Langkah Uji: Mengisi form pemesanan dengan data lengkap (nama, alamat, no HP, metode pembayaran).

Hasil:

Data berhasil disimpan dan tervalidasi dengan baik.

Status: Pass

7. Keamanan Session
Langkah Uji: Melakukan logout lalu mencoba kembali mengakses halaman dashboard tanpa login, serta memeriksa durasi aktif session.

Hasil:

Setelah logout, akses ke dashboard diblokir. Namun belum ada pengaturan durasi session (timeout).

Status: Sebagian Pass

8. Error Handling
Langkah Uji: Memutus koneksi database secara sengaja atau mematikan server API saat proses checkout.

Hasil:

Tidak muncul pesan error yang jelas, hanya halaman kosong atau loading terus-menerus.

Status: Fail

9. Logging Aktivitas
Langkah Uji: Memeriksa apakah aktivitas login dan transaksi dicatat dalam file log/server.

Hasil:

Tidak ditemukan pencatatan aktivitas login/transaksi di sisi backend.

Status: Fail

**HASIL KESIMPULAN**
| Status                         | Jumlah |
| ------------------------------ | ------ |
| **Pass**                       | 7      |
| **Fail**                       | 6      |
| **Sebagian** (tidak konsisten) | 2      |

**ANALISA HASIL TEST**

Berdasarkan hasil uji test case yang telah dilakukan terhadap berbagai fitur pada aplikasi website , berikut adalah analisis terhadap keberhasilan dan kegagalan sistem dalam memenuhi fungsionalitas yang diharapkan.

1. Fungsi Registrasi dan Login
Kelebihan:

Sistem dapat memproses login dengan data yang valid.

Registrasi berhasil menolak duplikasi akun.

Kekurangan:

Validasi username dan password masih longgar (tidak menolak karakter tidak valid atau panjang input berlebihan).

Tidak ada batasan panjang password yang dapat menyebabkan potensi risiko keamanan.

Analisa: Validasi input perlu diperkuat di sisi frontend dan backend untuk mencegah data tidak sah masuk ke sistem.

2. Tampilan Dashboard
Kelebihan:

Navigasi ditampilkan lengkap.

Tampilan selamat datang muncul sesuai pengguna yang login.

Analisa: Fitur ini bekerja sesuai ekspektasi dan memberikan pengalaman pengguna yang baik.

3. Menu dan Produk
Kelebihan:

Produk tampil sesuai data backend.

Analisa: Tidak ditemukan inkonsistensi data antara database dan UI, artinya integrasi data frontend dan backend berjalan baik.

4. Pemesanan Produk
Kekurangan:

Tombol pemesanan pada beberapa produk tidak memberikan respons.

Analisa: Terdapat kemungkinan kesalahan pada pemanggilan fungsi JavaScript atau kegagalan binding event handler di sisi frontend.

5. Checkout
Kekurangan:

Detail pesanan tidak dimunculkan.

Analisa: Menunjukkan kelemahan dalam pengambilan data pesanan dari server atau dalam penyimpanan session/cart.

6. Form Pemesanan
Kelebihan:

Data input tervalidasi dan tersimpan dengan baik.

Analisa: Form ini telah berhasil menangani input pengguna sesuai alur bisnis yang diharapkan.

7. Keamanan dan Session
Kekurangan:

Session timeout belum diterapkan.

Analisa: Perlu penambahan mekanisme auto-logout dan perlindungan session untuk meningkatkan keamanan akun pengguna.

8. Error Handling dan Logging
Kekurangan:

Tidak ada tampilan error yang jelas saat backend gagal merespons.

Logging aktivitas tidak ditemukan.

Analisa: Sistem tidak menyediakan informasi cukup saat terjadi kesalahan, yang dapat menyulitkan debugging dan memperbesar risiko keamanan.
| Aspek                       | Status Umum  | Rekomendasi                                                                  |
| --------------------------- | ------------ | ---------------------------------------------------------------------------- |
| Validasi Input              | Kurang baik  | Perkuat validasi di backend dan batasi panjang karakter pada form            |
| Konsistensi Data UI-Backend | Baik         | Tetap dijaga, pertahankan sinkronisasi antar sistem                          |
| Proses Pemesanan & Checkout | Perlu revisi | Periksa alur cart & checkout; pastikan tombol dan data diproses dengan benar |
| Keamanan Session            | Kurang       | Tambahkan session timeout dan proteksi akses setelah logout                  |
| Error Handling              | Lemah        | Implementasikan feedback error dan sistem logging                            |

