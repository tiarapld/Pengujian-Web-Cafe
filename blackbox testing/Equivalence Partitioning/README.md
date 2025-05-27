## 🧪 2. Equivalence Partitioning

# register

| No   | Parameter                        | Kelas Equivalen (Input)                                          | Valid / Invalid | Expected Output             | Actual Output      | Status |
| ---- | -------------------------------- | ---------------------------------------------------------------- | --------------- | --------------------------- | ------------------ | ------ |
  | EP1  | Username                         | "" (kosong)                                                      | Invalid         | Username diperlukan  | benar |    ✅    |
| EP2  | Username                         | "abc" (kurang dari 4 karakter)                                   | Invalid         | minimal 4 karakter   | benar |    ✅    |
| EP3  | Username                         | "user123" (>=4 karakter)                                         | Valid           | sukses                      | benar | ✅       |
| EP4  | Email                            | "" (kosong)                                                      | Invalid         | Email diperlukan     | benar |     ✅   |
| EP5  | Email                            | "abc.com" (format tidak valid)                                   | Invalid         | Email tidak valid    | benar |    ✅    |
| EP6  | Email                            | "email@email.com" (valid format)           | Valid           | sukses                      | benar |  ✅      |
| EP7  | Password                         | "" (kosong)                                                      | Invalid         | Password diperlukan  | benar |     ✅   |
| EP8  | Password                         | "12345" (<6 karakter)                                            | Invalid         | minimal 6 karakter   | benar |   ✅     |
| EP9  | Password                         | "abcdefg" (>=6 karakter)                                         | Valid           | sukses                      | benar  | ✅       |
| EP10 | Konfirmasi Password              | Tidak sama dengan password                                       | Invalid         | Password tidak cocok | benar |   ✅     |
| EP11 | Konfirmasi Password              | Sama dengan password                                             | Valid           | sukses                      | benar |✅        |
| EP12 | Username & Email sudah terdaftar | "userlama" / "email@email.com" | Invalid         | user/email sudah digunakan      | benar        |✅

# login
| No  | Parameter          | Nilai Input                       | Expected Output                | Actual Output | Status |
| --- | ------------------ | --------------------------------- | ------------------------------ | ------------- | ------ |
| EP1 | username |  ""                           | error                          | error         |  ✅     |
| EP2 | username | "12345" | sukses                          | error         | ✅      |
| EP3 | password |  "salah"              | error                          | error         | ✅      |
| EP4 |  password |  "benar"              | sukses (redirect ke index.php) | sukses        | ✅      |

# order

| No   | Parameter                        | Kelas Equivalen (Input)                                          | Valid / Invalid | Expected Output             | Actual Output      | Status |
| ---- | -------------------------------- | ---------------------------------------------------------------- | --------------- | --------------------------- | ------------------ | ------ |
| EP1  | Semua field                         | "" (kosong)                                                      | Invalid         | Username diperlukan  | benar |    ✅    |
| EP2  | email                         | "abc.com"                                   | Invalid         | email tidak valid   | benar |    ✅    |
| EP3  | no phone                        | "berisi abcd"                                      | inValid           | tidak diterima                      | salah | ❌       |
| EP4  | notes                            | "" (kosong)                                                      | valid         | diterima     | benar |     ✅   |
| EP5  | jumlah pesanan                          | ""                                                      | Invalid         | Perlu diisi     | benar |     ✅   |
