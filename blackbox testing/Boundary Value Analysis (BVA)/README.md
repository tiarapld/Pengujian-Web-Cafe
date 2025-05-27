
## Parameter

Fitur yang diuji: register, login, order

| test sace | Parameter     | batas valid                          | batas invalid  |               
|----|-------------|--------------------------------|----------------------------------|
| BVA1  | Registrasi| 1 - 15 karakter      |  kosong/ > 15 karakter                    |           
  | BVA2  | login| 1 -15  karakter     |   kosong/ >15 karakter   |               |


## 🧪 1. Boundary Value Analysis (BVA)
## Register
| No | Parameter     |  Input                          | Expected Output                 | Actual Output | Status |
|----|-------------|--------------------------------|----------------------------------|---------------|--------|
| BVA1 | username| "17"                     | error                        |    sukses           |    ❌    |
| BVA2  | username       | "4"                  | sukses                 | sukses              |   ✅      |
| BVA3  | email      | "20"            |    error      |  sukses             |    ❌    |
| BVA4  | email      | "@gmail.com"            |    sukses      |  error             |    ❌    |
| BVA5  | password      | "20"            |    sukses      |  sukses             |     ✅   |
| BVA6  | konfirmasi password      | "tidak sesuai"            |    sukses      |  error            |   ❌      |
---
## login
| No | Parameter     |  Input                          | Expected Output                 | Actual Output | Status |
|----|-------------|--------------------------------|----------------------------------|---------------|--------|
| BVA1  | username|        "tidak sesuai"             | error                        |    error           |     ✅   |
| BVA2  | password|        "kosong"             |           error              |    error           |     ✅   |
| BVA3  | password|        "5"             |           sukses              |    error           |    ❌    |

## order
| No | Parameter     |  Input                          | Expected Output                 | Actual Output | Status |
|----|-------------|--------------------------------|----------------------------------|---------------|--------|
| BVA1  | username|        " > 15 karakter"             | error                        |    sukses           |   ❌     |
| BVA2  | nomor telepon|        "> 13 karakter"             |           error              |    sukses          |     ❌   |
| BVA3  | email|        "@gmail.com"             |           error              |    error           |    ✅    |
