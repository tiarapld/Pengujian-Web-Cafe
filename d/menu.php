<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

require '../db.php';

$userId = $_SESSION['user_id'];

// Get user data
$user_stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$user_stmt->execute([$userId]);
$user = $user_stmt->fetch();

// Get menu items from database
try {
    $menu_stmt = $pdo->prepare('SELECT * FROM menu');
    $menu_stmt->execute();
    $menu_items = $menu_stmt->fetchAll();
} catch (PDOException $e) {
    die('Database error: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Menu - Cafe Aroma</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        :root {
            --primary-color: #3a2c2a;
            --secondary-color: #c8a97e;
            --light-color: #f9f5f0;
            --dark-color: #333;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: var(--dark-color);
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        /* Sidebar Styles */
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

        .user-profile {
            margin-top: 15px;
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

        /* Main Content Styles */
        .main-content {
            padding: 30px;
            overflow-x: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h1 {
            color: var(--primary-color);
            margin: 0;
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

        /* Menu Items Grid */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .menu-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .menu-image {
            height: 180px;
            overflow: hidden;
        }

        .menu-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .menu-card:hover .menu-image img {
            transform: scale(1.05);
        }

        .menu-details {
            padding: 20px;
        }

        .menu-title {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .menu-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .menu-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .menu-price {
            font-weight: bold;
            color: var(--secondary-color);
            font-size: 1.1rem;
        }

        .add-to-cart {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .add-to-cart:hover {
            background-color: #b89a6b;
        }

        /* Table Styles */
        table.menu-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 50px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        table.menu-table thead {
            background-color: var(--primary-color);
            color: white;
        }

        table.menu-table th,
        table.menu-table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table.menu-table tbody tr:hover {
            background-color: #f5f5f5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            .sidebar {
                display: none;
            }
        }
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

    body {
      background-color: var(--background-color);
      color: var(--text-color);
      transition: background-color 0.3s, color 0.3s;
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
        <!-- Sidebar -->
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
                    <li><a href="menu.php" class="active"><i class="fas fa-utensils"></i> Menu</a></li>
                    <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                    <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1><i class="fas fa-utensils"></i> Our Menu</h1>
                <a href="../index.php" class="back-button">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <!-- Grid Menu Cards -->
            <div class="menu-grid">
                <?php foreach ($menu_items as $item): ?>
                <div class="menu-card">
                    <div class="menu-image">
                        <img src="<?php echo htmlspecialchars($item['image_url'] ?? 'https://via.placeholder.com/300'); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" />
                    </div>
                    <div class="menu-details">
                        <h3 class="menu-title"><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p class="menu-description"><?php echo htmlspecialchars($item['description']); ?></p>
                        <div class="menu-footer">
                            <span class="menu-price">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></span>
                            <button class="add-to-cart" data-id="<?php echo $item['id']; ?>">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

           <!-- Tabel Menu -->
<!-- Tabel Menu -->
<table style="width: 100%; border-collapse: collapse; margin-top: 30px; border: 1px solid #ddd;">
    <thead>
        <tr style="background-color: #3a2c2a; color: white;">
            <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">No</th>
            <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Gambar</th>
            <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Nama Menu</th>
            <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Deskripsi</th>
            <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Harga</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="padding: 12px; border: 1px solid #ddd;">1</td>
            <td style="padding: 12px; border: 1px solid #ddd;">
                <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 6px;">
                    <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Espresso" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </td>
            <td style="padding: 12px; border: 1px solid #ddd;">Espresso</td>
            <td style="padding: 12px; border: 1px solid #ddd;">Kopi murni dengan rasa kuat dan crema yang sempurna</td>
            <td style="padding: 12px; border: 1px solid #ddd;">Rp 25.000</td>
        </tr>
        <tr>
            <td style="padding: 12px; border: 1px solid #ddd;">2</td>
            <td style="padding: 12px; border: 1px solid #ddd;">
                <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 6px;">
                    <img src="https://images.unsplash.com/photo-1551024506-0bccd828d307?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Cappuccino" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </td>
            <td style="padding: 12px; border: 1px solid #ddd;">Cappuccino</td>
            <td style="padding: 12px; border: 1px solid #ddd;">Perpaduan sempurna espresso, susu steamed, dan foam</td>
            <td style="padding: 12px; border: 1px solid #ddd;">Rp 30.000</td>
        </tr>
        <tr>
            <td style="padding: 12px; border: 1px solid #ddd;">3</td>
            <td style="padding: 12px; border: 1px solid #ddd;">
                <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 6px;">
                    <img src="https://images.unsplash.com/photo-1568649929103-28ffbefaca1e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Latte Art" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </td>
            <td style="padding: 12px; border: 1px solid #ddd;">Latte Art</td>
            <td style="padding: 12px; border: 1px solid #ddd;">Espresso dengan susu steamed dan seni latte yang indah</td>
            <td style="padding: 12px; border: 1px solid #ddd;">Rp 35.000</td>
        </tr>
        <tr>
            <td style="padding: 12px; border: 1px solid #ddd;">4</td>
            <td style="padding: 12px; border: 1px solid #ddd;">
                <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 6px;">
                    <img src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Avocado Toast" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </td>
            <td style="padding: 12px; border: 1px solid #ddd;">Avocado Toast</td>
            <td style="padding: 12px; border: 1px solid #ddd;">Roti panggang dengan alpukat tumbuk, telur, dan bumbu rahasia</td>
            <td style="padding: 12px; border: 1px solid #ddd;">Rp 45.000</td>
        </tr>
        <tr>
            <td style="padding: 12px; border: 1px solid #ddd;">5</td>
            <td style="padding: 12px; border: 1px solid #ddd;">
                <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 6px;">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Salad Bowl" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </td>
            <td style="padding: 12px; border: 1px solid #ddd;">Salad Bowl</td>
            <td style="padding: 12px; border: 1px solid #ddd;">Campuran sayuran segar dengan dressing khusus</td>
            <td style="padding: 12px; border: 1px solid #ddd;">Rp 40.000</td>
        </tr>
        <tr>
            <td style="padding: 12px; border: 1px solid #ddd;">6</td>
            <td style="padding: 12px; border: 1px solid #ddd;">
                <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 6px;">
                    <img src="https://images.unsplash.com/photo-1563805042-7684c019e1cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Croissant" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </td>
            <td style="padding: 12px; border: 1px solid #ddd;">Croissant</td>
            <td style="padding: 12px; border: 1px solid #ddd;">Croissant renyah dengan isian coklat atau keju</td>
            <td style="padding: 12px; border: 1px solid #ddd;">Rp 25.000</td>
        </tr>
    </tbody>
</table>

                <tbody>
                    <?php $no = 1; foreach ($menu_items as $item): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['description']); ?></td>
                        <td>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>

    <script>
        // Contoh fungsi add to cart (hanya alert)
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                alert('Menu ID ' + button.dataset.id + ' ditambahkan ke keranjang!');
            });
        });
    </script>
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

    // Cek localStorage saat halaman dimuat
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

</body>
</html>
