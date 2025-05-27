
#  Website Cafe Aroma - Black Box Testing Report


---

## Parameter

Fitur yang diuji: register, login, order

| test sace | Parameter     | batas valid                          | batas invalid  |               
|----|-------------|--------------------------------|----------------------------------|
| BVA1  | Registrasi| 1 - 15 karakter      |  kosong/ > 15 karakter                    |           
  | BVA2  | login| 1 -15  karakter     |   kosong/ >15 karakter   |               |


## 🧪 1. Boundary Value Analysis (BVA)

Fitur yang diuji: register, login
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
| No | Parameter     | Input                          | Expected Output                 | Actual Output | Status |
|----|-------------|--------------------------------|----------------------------------|---------------|--------|
| BVA1  | username|        "tidak sesuai yang diregister"             | error                        |    error           |     ✅   |
| BVA2  | password|        "kosong"             |           error              |    error           |     ✅   |
| BVA3  | password|        "5"             |           sukses              |    error           |    ❌    |

## 🧪 2. Equivalence Partitioning

| No | Parameter     |  Input                          | Expected Output                 | Actual Output | Status |
|----|-------------|--------------------------------|----------------------------------|---------------|--------|
| 1  | username| "kosong"l                    |                 Please fill out this field          |          benar     |    ✅     |
| 2  | username| "tidak sesuai"    | username atau password tidak valid            |      benar         |  ✅      |
| 3  | password       |   "kosong"                | Please fill out this field               |     benar          |     ✅   |
| 4  | password       | "kurang dari 6 karakter"                | username atau password tidak valid         |        benar       |   ✅     |

---

## 🧪 3. Decision Table Testing

| ID | CONDITION / ACTION                                       | TC1 | TC2 | TC3 | TC4 | TC5 |
| -- | -------------------------------------------------------- | --- | --- | --- | --- | --- |
| C1 | Username kosong                                          | T   | F   | F   | F   | F   |
| C2 | Password kosong                                          | F   | T   | F   | F   | F   |
| C3 | Password < 6 karakter                                    | F   | F   | T   | F   | F   |
| C4 | Username dan password valid tapi tidak cocok di database | F   | F   | F   | T   | F   |
| A1 | Tampilkan “Please fill out this field”                   | E   | E   |     |     |     |
| A2 | Tampilkan “Username atau password tidak valid”           |     |     | E   | E   |     |
| A3 | Login berhasil                                           |     |     |     |     | E   |


---

## 🧪 4. Comparison Testing

| No | Version       | Input Scenario          | Expected Consistency     | Actual Output | Status |
|----|---------------|--------------------------|---------------------------|---------------|--------|
| 1  | Dev & Prod    | Login functionality      | Same behavior             |               |        |
| 2  | Dev & Prod    | Order processing         | Same total & messages     |               |        |

---

## 🧪 5. Sample Testing

| No | Feature       | Sample Input             | Expected Output            | Actual Output | Status |
|----|---------------|--------------------------|-----------------------------|---------------|--------|
| 1  | Order         | Quantity: 1, 5, 10        | Valid orders                |               |        |
| 2  | Registration  | Username: 'user1', 'abc'  | Valid registrations         |               |        |

---

## 🧪 6. Robustness Testing

| No | Feature       | Input                            | Expected Output             | Actual Output | Status |
|----|---------------|----------------------------------|------------------------------|---------------|--------|
| 1  | Registration  | Username 300 chars               | Error, not accepted          |               |        |
| 2  | Login         | SQL injection (`' OR '1'='1`)    | Rejected, input sanitized    |               |        |

---

## 🧪 7. Behavior Testing (BDD)

| No | Scenario                                                     | Expected Behavior             | Actual Output | Status |
|----|--------------------------------------------------------------|-------------------------------|---------------|--------|
| 1  | As a user, I want to login to see my dashboard               | Dashboard page loads          |               |        |
| 2  | As a user, I want to order food and see confirmation         | Confirmation page shown       |               |        |

---

## 🧪 8. Performance Testing

| No | Scenario                             | Metric                         | Expected Result | Actual | Status |
|----|--------------------------------------|--------------------------------|------------------|--------|--------|
| 1  | 100 concurrent users login           | Response time < 2s             | Pass             |        |        |
| 2  | Load menu with 100 items             | Load within 1 second           | Pass             |        |        |

---

## 🧪 9. Endurance Testing

| No | Scenario                             | Duration/Repeats               | Expected Behavior | Actual | Status |
|----|--------------------------------------|--------------------------------|--------------------|--------|--------|
| 1  | Repeated login/logout                | 500 times                      | No crash/memory leak|        |        |
| 2  | Continuous ordering                  | 4 hours simulation             | Stable performance |        |        |

---

## 🧪 10. Cause-Effect Graphing

| No | Cause                               | Effect                         | Expected Output           | Actual | Status |
|----|-------------------------------------|--------------------------------|----------------------------|--------|--------|
| 1  | User clicks order + has balance     | Order confirmed                | Order Success Page         |        |        |
| 2  | User clicks order + no balance      | Order rejected                 | Error Message Shown        |        |        |

---

> ⚠️ **Note**: Please fill in the “Actual Output” and “Status” after running the test cases manually.

