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

