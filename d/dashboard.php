<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
require '../db.php';
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
$order_stmt = $pdo->prepare('SELECT id, order_date, total, status, 
                            (SELECT COUNT(*) FROM order_items WHERE order_id = orders.id) as items_count 
                            FROM orders 
                            WHERE user_id = ? 
                            ORDER BY order_date DESC LIMIT 5');
$order_stmt->execute([$_SESSION['user_id']]);
$recent_orders = $order_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile Customers - Cafe Aroma</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
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
      --shadow-color: rgba(0, 0, 0, 0.1);
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
      --shadow-color: rgba(255, 255, 255, 0.1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: var(--background-color);
      color: var(--text-color);
      transition: background-color 0.3s, color 0.3s;
    }

    .dashboard-container {
      display: grid;
      grid-template-columns: 250px 1fr;
      min-height: 100vh;
    }

    .sidebar {
      background-color: var(--primary-color);
      color: var(--light-color);
      padding: 20px 0;
    }

    .sidebar-header {
      padding: 0 20px 20px;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .sidebar-header h2 {
      display: flex;
      align-items: center;
      gap: 10px;
      color: var(--secondary-color);
    }

    .user-profile h4 {
      color: var(--secondary-color);
      margin-bottom: 5px;
    }

    .user-profile p {
      font-size: 0.8rem;
      color: rgba(255,255,255,0.7);
    }

    .nav-menu {
      margin-top: 20px;
    }

    .nav-menu ul {
      list-style: none;
    }

    .nav-menu li a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 20px;
      color: var(--light-color);
      text-decoration: none;
      transition: all 0.3s;
    }

    .nav-menu li a:hover,
    .nav-menu li a.active {
      background-color: rgba(200, 169, 126, 0.2);
      color: var(--secondary-color);
    }

    .main-content {
      padding: 30px;
    }

    h1 {
      color: var(--primary-color);
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .back-button {
      background-color: var(--secondary-color);
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 4px;
      text-decoration: none;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 5px;
      transition: background-color 0.3s;
    }

    .back-button:hover {
      background-color: #b89a6b;
    }

    .profile-info {
      background-color: var(--input-bg);
      border-radius: 8px;
      padding: 25px;
      box-shadow: 0 2px 10px var(--shadow-color);
      margin-bottom: 30px;
      display: flex;
      align-items: center;
      gap: 30px;
      color: var(--text-color);
    }

    .profile-picture {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid var(--secondary-color);
    }

    .profile-details {
      flex: 1;
      color: var(--text-color);
    }

    .profile-info h3 {
      margin-bottom: 15px;
      color: var(--primary-color);
    }

    .profile-info p {
      margin-bottom: 8px;
      color: var(--text-color);
    }

    .edit-button {
      display: inline-block;
      background-color: var(--secondary-color);
      color: white;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      margin-top: 10px;
      text-decoration: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .edit-button:hover {
      background-color: #b89a6b;
    }

    #toggleModeBtn {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 100;
      background-color: var(--secondary-color);
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    #toggleModeBtn:hover {
      background-color: #b89a6b;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <aside class="sidebar">
      <div class="sidebar-header">
        <h2><i class="fas fa-coffee"></i> Cafe Aroma</h2>
        <div class="user-profile">
          <h4><?= htmlspecialchars($user['username']) ?></h4>
          <p>Member since <?= date('M Y', strtotime($user['created_at'])) ?></p>
        </div>
      </div>
      <nav class="nav-menu">
        <ul>
          <li><a href="dashboard.php" class="active"><i class="fas fa-user"></i> Profile</a></li>
          <li><a href="menu.php"><i class="fas fa-utensils"></i> Menu</a></li>
          <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
          <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
      </nav>
    </aside>

    <main class="main-content">
      <h1>
        My Profile
        <a href="../index.php" class="back-button">
          <i class="fas fa-arrow-left"></i> Kembali
        </a>
      </h1>

      <div class="profile-info">
        <?php 
          $profile_img = 'https://via.placeholder.com/120';
          if (!empty($user['profile_photo']) && file_exists('uploads/' . $user['profile_photo'])) {
              $profile_img = 'uploads/' . $user['profile_photo'];
          }
        ?>
        <img src="<?= $profile_img ?>" alt="Profile Picture" class="profile-picture">
        <div class="profile-details">
          <h3>Profile Information</h3>
          <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
          <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
          <p><strong>Member Since:</strong> <?= date('d M Y', strtotime($user['created_at'])) ?></p>
          <a href="edit_profile.php" class="edit-button"><i class="fas fa-edit"></i> Edit Profile</a>
        </div>
      </div>
    </main>
  </div>

  <button id="toggleModeBtn" title="Mode">
    <i class="fas fa-moon"></i> Mode Gelap
  </button>

  <script>
    const toggleBtn = document.getElementById("toggleModeBtn");
    const body = document.body;

    function setMode(mode) {
      if (mode === "dark") {
        body.classList.add("dark-mode");
        toggleBtn.innerHTML = '<i class="fas fa-sun"></i> Mode Terang';
      } else {
        body.classList.remove("dark-mode");
        toggleBtn.innerHTML = '<i class="fas fa-moon"></i> Mode Gelap';
      }
    }

    const savedMode = localStorage.getItem("mode") || "light";
    setMode(savedMode);

    toggleBtn.addEventListener("click", () => {
      const currentMode = body.classList.contains("dark-mode") ? "dark" : "light";
      const newMode = currentMode === "dark" ? "light" : "dark";
      localStorage.setItem("mode", newMode);
      setMode(newMode);
    });
  </script>
</body>
</html>
