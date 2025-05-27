
#  Cafe App - Black Box Testing Report


---

## 🔍 Fitur yang diuji

## 🧪 1. Boundary Value Analysis (BVA)
##🔍 Fitur yang diuji

| No | Feature     | Input                          | Expected Output                 | Actual Output | Status |
|----|-------------|--------------------------------|----------------------------------|---------------|--------|
| 1  | Registration| Username 3 characters          | Accepted                        |               |        |
| 2  | Registration| Username 2 characters          | Rejected with error message     |               |        |
| 3  | Order       | Quantity = 1                   | Accepted                        |               |        |
| 4  | Order       | Quantity = 0                   | Rejected                        |               |        |

---

## 🧪 2. Equivalence Partitioning

| No | Feature     | Input                          | Expected Output                 | Actual Output | Status |
|----|-------------|--------------------------------|----------------------------------|---------------|--------|
| 1  | Registration| Valid email                    | Accepted                        |               |        |
| 2  | Registration| Invalid email (e.g. no '@')    | Rejected with error             |               |        |
| 3  | Order       | Valid menu ID                  | Order processed                 |               |        |
| 4  | Order       | Invalid menu ID                | Error or item not found         |               |        |

---

## 🧪 3. Decision Table Testing

| No | Condition                              | Action             | Expected Output         | Actual Output | Status |
|----|----------------------------------------|--------------------|--------------------------|---------------|--------|
| 1  | User logged in + Menu available        | Place order        | Success confirmation     |               |        |
| 2  | User not logged in + Menu available    | Place order        | Redirect to login        |               |        |

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

