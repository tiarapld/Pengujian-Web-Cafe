<?php
session_start();
require 'db.php';

$error = '';

if (isset($_SESSION['success_message'])) {
    $success = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
} else {
    $success = '';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Café</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: url('https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
            padding: 20px;
            color: #333;
        }

        .login-container {
            max-width: 450px;
            margin: 80px auto;
            padding: 30px;
            background: rgba(255, 248, 240, 0.95);
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
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
            font-weight: 600;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #c7a17a;
            border-radius: 6px;
            background-color: #fffaf0;
            font-size: 15px;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #a47148;
            outline: none;
            box-shadow: 0 0 5px rgba(164, 113, 72, 0.4);
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

        .error, .success {
            text-align: center;
            margin-bottom: 15px;
            font-weight: 600;
            padding: 10px;
            border-radius: 4px;
        }

        .error {
            background-color: #fadbd8;
            color: #c0392b;
        }

        .success {
            background-color: #d5f5e3;
            color: #27ae60;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .register-link a {
            color: #6f4e37;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login ke Café Library</h2>
        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Nama Pengguna</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Masuk</button>
        </form>
        <div class="register-link">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </div>
    </div>
</body>
</html>
