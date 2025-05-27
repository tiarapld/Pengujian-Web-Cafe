<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

require '../db.php';

$userId = $_SESSION['user_id'];

// Ambil data user dari database
$user_stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$user_stmt->execute([$userId]);
$user = $user_stmt->fetch();

// Jika form disubmit
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if ($username === '' || $email === '') {
        $message = 'Username dan email tidak boleh kosong.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Format email tidak valid.';
    } elseif ($password !== '' && $password !== $password_confirm) {
        $message = 'Password dan konfirmasi password tidak cocok.';
    } else {
        if ($password !== '') {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $update_stmt = $pdo->prepare('UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?');
            $update_stmt->execute([$username, $email, $password_hash, $userId]);
        } else {
            $update_stmt = $pdo->prepare('UPDATE users SET username = ?, email = ? WHERE id = ?');
            $update_stmt->execute([$username, $email, $userId]);
        }
        $message = 'Data berhasil diperbarui.';
        $user_stmt->execute([$userId]);
        $user = $user_stmt->fetch();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Settings - Cafe Aroma</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <style>
    :root {
      --primary-color: #3a2c2a;
      --secondary-color: #c8a97e;
      --light-color: #f9f5f0;
      --dark-color: #333;
      --danger-color: #cc3333;
      --background-color: #f5f5f5;
      --text-color: var(--dark-color);
      --input-bg: #fff;
      --input-border: #ccc;
      --shadow-color: rgba(0,0,0,0.1);
    }
    body.dark-mode {
      --primary-color: #c8a97e;
      --secondary-color: #3a2c2a;
      --light-color: #222;
      --dark-color: #f5f5f5;
      --danger-color: #ff6b6b;
      --background-color: #222;
      --text-color: #eee;
      --input-bg: #333;
      --input-border: #555;
      --shadow-color: rgba(255,255,255,0.1);
    }
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    body { background-color: var(--background-color); color: var(--text-color); transition: background-color 0.3s, color 0.3s; }
    .dashboard-container { display: grid; grid-template-columns: 250px 1fr; min-height: 100vh; }
    .sidebar { background-color: var(--primary-color); color: var(--light-color); padding: 20px 0; }
    .sidebar-header { padding: 0 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); }
    .sidebar-header h2 { display: flex; align-items: center; gap: 10px; color: var(--secondary-color); }
    .user-profile { margin-top: 15px; }
    .user-profile h4 { color: var(--secondary-color); margin-bottom: 5px; }
    .user-profile p { font-size: 0.8rem; color: rgba(255,255,255,0.7); }
    .nav-menu { margin-top: 20px; }
    .nav-menu ul { list-style: none; }
    .nav-menu li a {
      display: flex; align-items: center; gap: 10px;
      padding: 12px 20px; color: var(--light-color);
      text-decoration: none; transition: all 0.3s;
    }
    .nav-menu li a:hover, .nav-menu li a.active {
      background-color: rgba(200, 169, 126, 0.2); color: var(--secondary-color);
    }
    .main-content {
      padding: 30px; overflow-x: auto;
      background: var(--input-bg); border-radius: 8px;
      box-shadow: 0 2px 10px var(--shadow-color); margin: 30px;
      transition: background 0.3s, box-shadow 0.3s;
    }
    .page-header {
      display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;
    }
    h1 { color: var(--primary-color); margin: 0; transition: color 0.3s; }
    .back-button {
      background-color: var(--secondary-color); color: white;
      border: none; padding: 8px 15px; border-radius: 4px;
      text-decoration: none; font-size: 14px; display: flex;
      align-items: center; gap: 5px; cursor: pointer;
      transition: background-color 0.3s;
    }
    .back-button:hover { background-color: #b89a6b; }
    form { max-width: 500px; }
    label {
      display: block; margin-bottom: 6px;
      font-weight: 600; color: var(--primary-color);
      transition: color 0.3s;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%; padding: 10px 12px; margin-bottom: 20px;
      border: 1px solid var(--input-border); border-radius: 4px;
      font-size: 1rem; background-color: var(--input-bg);
      color: var(--text-color); transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }
    button[type="submit"] {
      background-color: var(--secondary-color); color: white;
      border: none; padding: 12px 20px; border-radius: 4px;
      font-size: 1rem; cursor: pointer; transition: background-color 0.3s;
    }
    button[type="submit"]:hover { background-color: #b89a6b; }
    .message { margin-bottom: 20px; font-weight: 600; color: var(--danger-color); transition: color 0.3s; }
    .message.success { color: var(--primary-color); }
    .toggle-switch {
      position: relative; display: inline-block;
      width: 60px; height: 34px; vertical-align: middle;
    }
    .toggle-switch input { opacity: 0; width: 0; height: 0; }
    .slider {
      position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
      background-color: var(--input-border); transition: 0.4s; border-radius: 34px;
    }
    .slider:before {
      position: absolute; content: ""; height: 26px; width: 26px;
      left: 4px; bottom: 4px; background-color: white;
      transition: 0.4s; border-radius: 50%;
    }
    input:checked + .slider { background-color: var(--secondary-color); }
    input:checked + .slider:before { transform: translateX(26px); }
    .toggle-icon {
      position: absolute; top: 50%; transform: translateY(-50%);
      font-size: 16px; color: var(--input-bg); pointer-events: none;
      user-select: none;
    }
    .toggle-icon.sun { left: 8px; opacity: 0; transition: opacity 0.4s; }
    .toggle-icon.moon { right: 8px; opacity: 1; transition: opacity 0.4s; }
    input:checked ~ .toggle-icon.sun { opacity: 1; }
    input:checked ~ .toggle-icon.moon { opacity: 0; }
    @media (max-width: 768px) {
      .dashboard-container { grid-template-columns: 1fr; }
      .sidebar { display: none; }
      .main-content { margin: 10px; }
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <aside class="sidebar">
      <div class="sidebar-header">
        <h2><i class="fas fa-coffee"></i> Cafe Aroma</h2>
        <div class="user-profile">
          <h4><?php echo htmlspecialchars($user['username']); ?></h4>
          <p>Member since <?php echo date('M Y', strtotime($user['created_at'])); ?></p>
        </div>
      </div>
      <nav class="nav-menu">
        <ul>
          <li><a href="dashboard.php"><i class="fas fa-user"></i> Profile</a></li>
          <li><a href="menu.php"><i class="fas fa-utensils"></i> Menu</a></li>
          <li><a href="settings.php" class="active"><i class="fas fa-cog"></i> Settings</a></li>
          <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
      </nav>
    </aside>

    <main class="main-content">
      <div class="page-header">
        <h1><i class="fas fa-cog"></i> Settings</h1>
        <button class="back-button" id="backBtn" title="Kembali">
          <i class="fas fa-arrow-left"></i> Kembali
        </button>
      </div>

      <?php if ($message): ?>
        <div class="message <?php echo strpos($message, 'berhasil') !== false ? 'success' : 'error'; ?>">
          <?php echo htmlspecialchars($message); ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="settings.php">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required />

        <label for="password">Password Baru (kosongkan jika tidak ingin mengubah)</label>
        <input type="password" id="password" name="password" placeholder="Password baru" />

        <label for="password_confirm">Konfirmasi Password Baru</label>
        <input type="password" id="password_confirm" name="password_confirm" placeholder="Konfirmasi password" />

        <button type="submit">Simpan Perubahan</button>
      </form>

      <div style="margin-top: 30px; display: flex; align-items: center; gap: 10px;">
        <label for="darkModeToggle" style="font-weight: 600; color: var(--primary-color); cursor: pointer;">Mode Gelap</label>
        <label class="toggle-switch">
          <input type="checkbox" id="darkModeToggle" />
          <span class="slider"></span>
          <i class="fas fa-sun toggle-icon sun"></i>
          <i class="fas fa-moon toggle-icon moon"></i>
        </label>
      </div>
    </main>
  </div>

  <script>
    const darkToggle = document.getElementById('darkModeToggle');
    const body = document.body;

    function loadMode() {
      const mode = localStorage.getItem('mode');
      if (mode === 'dark') {
        body.classList.add('dark-mode');
        darkToggle.checked = true;
      } else {
        body.classList.remove('dark-mode');
        darkToggle.checked = false;
      }
    }

    darkToggle.addEventListener('change', () => {
      if (darkToggle.checked) {
        body.classList.add('dark-mode');
        localStorage.setItem('mode', 'dark');
      } else {
        body.classList.remove('dark-mode');
        localStorage.setItem('mode', 'light');
      }
    });

    loadMode();

    // Kembali langsung ke halaman index
    const backBtn = document.getElementById('backBtn');
    backBtn.addEventListener('click', () => {
      window.location.href = '../index.php';
    });
  </script>
</body>
</html>
