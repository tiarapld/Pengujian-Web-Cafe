## 🧪 2. Equivalence Partitioning

# login
| No | Parameter     | Nilai Input                          | Expected Output                 | Actual Output | Status |
|----|-------------|--------------------------------|----------------------------------|---------------|--------|
| 1  | username| "kosong"l                    |                 Please fill out this field          |          benar     |    ✅     |
| 2  | username| "tidak sesuai"    | username atau password tidak valid            |      benar         |  ✅      |
| 3  | password       |   "kosong"                | Please fill out this field               |     benar          |     ✅   |
| 4  | password       | "kurang dari 6 karakter"                | username atau password tidak valid         |        benar       |   ✅     |

