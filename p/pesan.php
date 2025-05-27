<?php
session_start();
$product_id = $_GET['id'] ?? null;

// Product data with images
$products = [
    '1' => [
        'name' => 'Espresso', 
        'price' => 'Rp 25.000',
        'image' => 'https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&h=500&q=80'
    ],
    '2' => [
        'name' => 'Cappuccino', 
        'price' => 'Rp 30.000',
        'image' => 'https://images.unsplash.com/photo-1551024506-0bccd828d307?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&h=500&q=80'
    ],
    '3' => [
        'name' => 'Latte Art', 
        'price' => 'Rp 35.000',
        'image' => 'https://images.unsplash.com/photo-1568649929103-28ffbefaca1e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&h=500&q=80'
    ],
    '4' => [
        'name' => 'Avocado Toast', 
        'price' => 'Rp 45.000',
        'image' => 'https://images.unsplash.com/photo-1484723091739-30a097e8f929?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&h=500&q=80'
    ],
    '5' => [
        'name' => 'Salad Bowl', 
        'price' => 'Rp 40.000',
        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&h=500&q=80'
    ],
    '6' => [
        'name' => 'Croissant', 
        'price' => 'Rp 25.000',
        'image' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&h=500&q=80'
    ]
];

$product = $products[$product_id] ?? null;

if (!$product) {
    header("Location: ../index.php#menu");
    exit;
}

$page_title = "Pesan " . $product['name'] . " | Cafe Aroma";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            --card-bg: #ffffff;
            --warning-bg: rgba(200, 169, 126, 0.1);
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
            --card-bg: #2a2a2a;
            --warning-bg: rgba(58, 44, 42, 0.3);
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
            line-height: 1.6;
            padding-top: 70px;
            font-family: 'Poppins', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Header Styles */
        header {
            background-color: var(--primary-color);
            padding: 15px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px var(--shadow-color);
            transition: background-color 0.3s;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
        }

        .logo i {
            color: var(--secondary-color);
            font-size: 1.3rem;
        }

        .user-actions {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .user-actions a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .user-actions a:hover {
            color: var(--secondary-color);
        }

        /* Main Content */
        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 30px;
        }

        .product-card {
            background: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 5px 15px var(--shadow-color);
            overflow: hidden;
            height: fit-content;
            transition: background-color 0.3s;
        }

        .product-header {
            background: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .product-header h2 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .product-body {
            padding: 25px;
        }

        .product-image-container {
            position: relative;
            width: 100%;
            padding-top: 100%; /* 1:1 Aspect Ratio */
            overflow: hidden;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px var(--shadow-color);
        }

        .product-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-name {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 10px;
            font-weight: 600;
        }

        .product-price {
            font-size: 1.5rem;
            color: var(--secondary-color);
            font-weight: 700;
            margin-bottom: 20px;
            display: block;
        }

        /* Warning Text */
        .peringatan {
            color: var(--text-color);
            padding: 12px;
            background-color: var(--warning-bg);
            border-radius: 6px;
            margin: 15px 0;
            border-left: 4px solid var(--secondary-color);
        }

        /* Order Form */
        .order-form {
            background: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 5px 15px var(--shadow-color);
            padding: 30px;
            height: fit-content;
            transition: background-color 0.3s;
        }

        .form-title {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--input-border);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--input-border);
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: var(--input-bg);
            color: var(--text-color);
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(200, 169, 126, 0.2);
            outline: none;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            color: white;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px var(--shadow-color);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            margin-top: 20px;
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .back-btn i {
            margin-right: 8px;
        }

        .back-btn:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        /* Footer */
        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 30px 0;
            margin-top: 50px;
            text-align: center;
            transition: background-color 0.3s;
        }

        /* Dark Mode Toggle Button */
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
            box-shadow: 0 2px 10px var(--shadow-color);
            transition: all 0.3s;
        }

        #toggleModeBtn:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                padding: 0 15px;
            }
            
            .product-image-container {
                padding-top: 75%; /* Adjust aspect ratio for mobile */
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <div class="logo">
                <i class="fas fa-coffee"></i>
                <span>Cafe Aroma</span>
            </div>
            
            <div class="user-actions">
                <a href="../d/dashboard.php"><i class=></i> Profile</a>
                <a href="../logout.php"><i class=></i> Logout</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- Product Card -->
        <div class="product-card">
            <div class="product-header">
                <h2>Detail Produk</h2>
            </div>
            <div class="product-body">
                <div class="product-name"><?php echo $product['name']; ?></div>
                <div class="product-price"><?php echo $product['price']; ?></div>
                
                <div class="product-image-container">
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
                </div>
                
                <p class="peringatan">Pastikan data pemesanan Anda sudah benar sebelum mengkonfirmasi pesanan.</p>
            </div>
        </div>

        <!-- Order Form -->
        <div class="order-form">
            <h2 class="form-title">Form Pemesanan</h2>
            
            <form action="proses_pesan.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                
                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control" required placeholder="Masukkan nama lengkap Anda">
                </div>
                
                <div class="form-group">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" class="form-control" required placeholder="Contoh: 08123456789">
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control" required placeholder="Contoh: email@domain.com">
                </div>
                
                <div class="form-group">
                    <label for="quantity" class="form-label">Jumlah Pesanan</label>
                    <select id="quantity" name="quantity" class="form-control" required>
                        <option value="" disabled selected>Pilih jumlah</option>
                        <?php for($i = 1; $i <= 10; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="notes" class="form-label">Catatan Tambahan</label>
                    <textarea id="notes" name="notes" class="form-control" placeholder="Contoh: Kurangi gula, tambah es, dll."></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Konfirmasi Pesanan
                </button>
                
                <a href="product_detail.php?id=<?php echo $product_id; ?>" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Kembali ke Detail Produk
                </a>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div>
            <p>&copy; <?php echo date('Y'); ?> Cafe Aroma. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Dark Mode Toggle Button -->
    <button id="toggleModeBtn" title="Toggle Dark Mode">
        <i class="fas fa-moon"></i> Mode Gelap
    </button>

    <script>
        const toggleBtn = document.getElementById("toggleModeBtn");
        const body = document.body;
        const icon = toggleBtn.querySelector("i");

        // Check for saved mode preference or use preferred color scheme
        const savedMode = localStorage.getItem("mode");
        const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;

        if (savedMode === "dark" || (!savedMode && prefersDark)) {
            enableDarkMode();
        }

        // Toggle dark/light mode
        toggleBtn.addEventListener("click", () => {
            if (body.classList.contains("dark-mode")) {
                disableDarkMode();
            } else {
                enableDarkMode();
            }
        });

        function enableDarkMode() {
            body.classList.add("dark-mode");
            icon.classList.replace("fa-moon", "fa-sun");
            toggleBtn.innerHTML = '<i class="fas fa-sun"></i> Mode Terang';
            localStorage.setItem("mode", "dark");
        }

        function disableDarkMode() {
            body.classList.remove("dark-mode");
            icon.classList.replace("fa-sun", "fa-moon");
            toggleBtn.innerHTML = '<i class="fas fa-moon"></i> Mode Gelap';
            localStorage.setItem("mode", "light");
        }

        // Listen for changes in OS color scheme preference
        window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", e => {
            if (!localStorage.getItem("mode")) {
                if (e.matches) {
                    enableDarkMode();
                } else {
                    disableDarkMode();
                }
            }
        });
    </script>
</body>
</html>