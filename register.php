<?php
session_start();
require 'db.php';

$errors = [];
$username = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username)) {
        $errors['username'] = 'Username diperlukan';
    } elseif (strlen($username) < 4) {
        $errors['username'] = 'Username minimal 4 karakter';
    }

    if (empty($email)) {
        $errors['email'] = 'Email diperlukan';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email tidak valid';
    }

    if (empty($password)) {
        $errors['password'] = 'Password diperlukan';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password minimal 6 karakter';
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Password tidak cocok';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? OR email = ?');
        $stmt->execute([$username, $email]);
        $user = $stmt->fetch();

        if ($user) {
            if ($user['username'] === $username) {
                $errors['username'] = 'Username sudah digunakan';
            }
            if ($user['email'] === $email) {
                $errors['email'] = 'Email sudah digunakan';
            }
        }
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
            $stmt->execute([$username, $email, $hashed_password]);

            $_SESSION['success_message'] = 'Registrasi berhasil! Silakan login.';
            header('Location: login.php');
            exit;
        } catch (PDOException $e) {
            $errors['database'] = 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Café Library</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background: url('https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .register-container {
            max-width: 500px;
            margin: 60px auto;
            padding: 30px;
            background: rgba(255, 248, 240, 0.95);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #5e412f;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #4e342e;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #c7a17a;
            border-radius: 6px;
            background-color: #fffaf0;
            font-size: 15px;
        }

        input:focus {
            border-color: #a47148;
            outline: none;
            box-shadow: 0 0 5px rgba(164, 113, 72, 0.5);
        }

        .error {
            color: #d9534f;
            font-size: 14px;
            margin-top: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #a47148;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        button:hover {
            background-color: #8b5e3c;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .login-link a {
            color: #6f4e37;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #d9534f;
            background-color: #fbe9e7;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Daftar Akun Café Library</h2>

        <?php if (!empty($errors['database'])): ?>
            <div class="error-message">
                <?php echo $errors['database']; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="username">Nama Pengguna</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                <?php if (isset($errors['username'])): ?>
                    <span class="error"><?php echo $errors['username']; ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                <?php if (isset($errors['email'])): ?>
                    <span class="error"><?php echo $errors['email']; ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" required>
                <?php if (isset($errors['password'])): ?>
                    <span class="error"><?php echo $errors['password']; ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="confirm_password">Konfirmasi Sandi</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <?php if (isset($errors['confirm_password'])): ?>
                    <span class="error"><?php echo $errors['confirm_password']; ?></span>
                <?php endif; ?>
            </div>

            <button type="submit">Daftar</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="login.php">Masuk di sini</a>
        </div>
    </div>
</body>
</html>
