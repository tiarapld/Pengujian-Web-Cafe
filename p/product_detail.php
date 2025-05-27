<?php
session_start();
$product_id = $_GET['id'] ?? null;

// Data produk (semua 6 produk)
$products = [
    '1' => [
        'name' => 'Espresso',
        'description' => 'Kopi murni dengan rasa kuat dan crema yang sempurna, dibuat dari biji kopi pilihan yang di-roasting khusus untuk memberikan pengalaman rasa yang mendalam.',
        'price' => 'Rp 25.000',
        'image' => 'https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
        'details' => 'Espresso kami dibuat dengan mesin profesional yang mempertahankan suhu dan tekanan ideal. Setiap shot mengandung 30ml kopi murni dengan crema tebal. Biji kopi berasal dari perkebunan di Jawa Barat dengan proses roasting medium untuk menyeimbangkan acidity dan body.',
        'category' => 'Minuman Panas',
        'rating' => '4.8'
    ],
    '2' => [
        'name' => 'Cappuccino',
        'description' => 'Perpaduan sempurna espresso, susu steamed, dan foam dengan rasio 1:1:1 yang memberikan keseimbangan rasa sempurna.',
        'price' => 'Rp 30.000',
        'image' => 'https://images.unsplash.com/photo-1551024506-0bccd828d307?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
        'details' => 'Kami menggunakan susu segar lokal dengan kadar lemak ideal untuk menghasilkan foam yang halus dan creamy. Dapat ditambahkan bubuk coklat atau kayu manis sesuai selera. Ukuran standar kami adalah 180ml dengan 1 shot espresso (30ml), 75ml susu steamed, dan 75ml foam.',
        'category' => 'Minuman Panas',
        'rating' => '4.9'
    ],
    '3' => [
        'name' => 'Latte Art',
        'description' => 'Espresso dengan susu steamed dan seni latte yang indah, memberikan pengalaman visual dan rasa yang memuaskan.',
        'price' => 'Rp 35.000',
        'image' => 'https://images.unsplash.com/photo-1568649929103-28ffbefaca1e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
        'details' => 'Latte art kami dibuat oleh barista berpengalaman dengan teknik free pour. Setiap latte mengandung 1 shot espresso (30ml) dan 150ml susu steamed dengan lapisan foam tipis. Seni yang sering kami buat antara lain heart, rosetta, atau tulip. Dapat juga dibuat dengan susu almond atau oat milk.',
        'category' => 'Minuman Panas',
        'rating' => '4.7'
    ],
    '4' => [
        'name' => 'Avocado Toast',
        'description' => 'Roti panggang dengan alpukat tumbuk, telur, dan bumbu rahasia yang memberikan cita rasa unik.',
        'price' => 'Rp 45.000',
        'image' => 'https://images.unsplash.com/photo-1484723091739-30a097e8f929?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
        'details' => 'Menggunakan roti sourdough panggang dengan alpukat organik tumbuk kasar, telur mata sapi (bisa diganti scrambled atau rebus), taburan biji chia, cabai merah kering, dan sedikit perasan lemon. Disajikan dengan salad microgreens dan pilihan sides. Bisa ditambahkan smoked salmon dengan tambahan biaya.',
        'category' => 'Makanan',
        'rating' => '4.6'
    ],
    '5' => [
        'name' => 'Salad Bowl',
        'description' => 'Campuran sayuran segar dengan dressing khusus yang sehat dan menyegarkan.',
        'price' => 'Rp 40.000',
        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
        'details' => 'Salad bowl kami berisi mix greens (lettuce, kale, spinach), cherry tomato, cucumber, red onion, avocado, dan pilihan protein (ayam grill, tofu, atau tempe). Dressing pilihan: honey mustard, balsamic vinaigrette, atau sesame ginger. Bisa ditambahkan quinoa atau roasted sweet potato dengan tambahan biaya.',
        'category' => 'Makanan Sehat',
        'rating' => '4.5'
    ],
    '6' => [
        'name' => 'Croissant',
        'description' => 'Croissant renyah dengan isian coklat atau keju, sempurna untuk teman minum kopi.',
        'price' => 'Rp 25.000',
        'image' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
        'details' => 'Croissant kami dibuat dengan teknik laminasi tradisional menggunakan butter premium. Pilihan isian: dark chocolate batang, chocolate hazelnut spread, atau keju edam. Dipanggang fresh setiap pagi dan disajikan hangat. Bisa dipanaskan kembali sesuai permintaan.',
        'category' => 'Snack',
        'rating' => '4.4'
    ]
];

$product = $products[$product_id] ?? null;

if (!$product) {
    header("Location: ../index.php#menu");
    exit;
}

$page_title = $product['name'] . " | Cafe Aroma";
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
            --background-color: #f5f5f5;
            --text-color: #333;
            --menu-bg: #fff;
            --menu-item-bg: #f9f5f0;
            --section-bg: #f9f5f0;
            --footer-bg: #3a2c2a;
            --input-bg: #fff;
            --input-border: #ccc;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --text-muted: #777;
        }

        body.dark-mode {
            --primary-color: #c8a97e;
            --secondary-color: #3a2c2a;
            --light-color: #222;
            --dark-color: #f5f5f5;
            --background-color: #1a1a1a;
            --text-color: #e0e0e0;
            --menu-bg: #2a2a2a;
            --menu-item-bg: #2a2a2a;
            --section-bg: #1a1a1a;
            --footer-bg: #2a1e1c;
            --input-bg: #333;
            --input-border: #555;
            --shadow-color: rgba(255, 255, 255, 0.1);
            --text-muted: #aaa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }
        
        body {
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            padding-top: 80px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin: 50px 0;
        }

        .product-image {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow-color);
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .product-info h1 {
            font-size: 36px;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .product-info .price {
            font-size: 24px;
            color: var(--secondary-color);
            font-weight: bold;
            margin: 20px 0;
            display: block;
        }

        .product-info .description {
            margin-bottom: 20px;
            color: var(--text-muted);
            line-height: 1.8;
        }

        .product-info .details {
            background-color: var(--menu-item-bg);
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
        }

        .product-info .details h3 {
            margin-bottom: 15px;
            color: var(--primary-color);
        }

        .product-info .details p {
            line-height: 1.8;
        }

        .product-meta {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .product-category {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
        }

        .product-rating {
            color: var(--secondary-color);
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .product-rating i {
            color: #ffc107;
            margin-right: 5px;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border-radius: 4px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #b89a6b;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px var(--shadow-color);
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border-radius: 4px;
            font-weight: 600;
            text-decoration: none;
            margin: 20px 0;
            transition: all 0.3s;
        }

        .back-btn:hover {
            background-color: #b89a6b;
            transform: translateY(-2px);
            box-shadow: 0 2px 10px var(--shadow-color);
        }

        .back-btn i {
            margin-right: 5px;
        }

        @media (max-width: 768px) {
            .product-detail {
                grid-template-columns: 1fr;
            }
            
            .product-info h1 {
                font-size: 28px;
            }
        }

        /* Header Styles */
        /* Header Styles */
header {
    background-color: var(--primary-color);
    color: var(--light-color);
    padding: 15px 0;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
    font-size: 24px;
    font-weight: 700;
}

.logo a {
    color: var(--light-color);
    text-decoration: none;
}

.logo i {
    margin-right: 10px;
    color: var(--secondary-color);
}

nav ul {
    display: flex;
    list-style: none;
    gap: 20px;
}

nav ul li a {
    color: var(--light-color);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

nav ul li a:hover {
    color: var(--secondary-color);
}

.user-menu {
    display: flex;
    gap: 15px;
}

.user-menu a {
    color: var(--light-color);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

.user-menu a:hover {
    color: var(--secondary-color);
}
        
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: var(--secondary-color);
            bottom: -5px;
            left: 0;
            transition: width 0.3s;
        }
        
        nav ul li a:hover::after {
            width: 100%;
        }
        
        .auth-buttons a {
            margin-left: 15px;
            padding: 8px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .auth-buttons .login {
            border: 1px solid var(--secondary-color);
            color: var(--secondary-color);
        }
        
        .auth-buttons .login:hover {
            background-color: var(--secondary-color);
            color: var(--primary-color);
        }
        
        .auth-buttons .register {
            background-color: var(--secondary-color);
            color: var(--primary-color);
        }
        
        .auth-buttons .register:hover {
            background-color: #b89a6b;
        }

        /* Footer Styles */
        footer {
            background-color: var(--footer-bg);
            color: var(--light-color);
            padding: 50px 0 20px;
        }
        
        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .footer-col h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: var(--secondary-color);
        }
        
        .footer-col p, .footer-col a {
            margin-bottom: 10px;
            display: block;
            color: #ddd;
            transition: color 0.3s;
        }
        
        .footer-col a:hover {
            color: var(--secondary-color);
        }
        
        .social-links {
            display: flex;
            gap: 15px;
        }
        
        .social-links a {
            font-size: 20px;
        }
        
        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #555;
            color: #aaa;
            font-size: 14px;
            max-width: 1200px;
            margin: 0 auto;
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
<body class="<?php echo isset($_COOKIE['mode']) && $_COOKIE['mode'] === 'dark' ? 'dark-mode' : ''; ?>">
    <!-- Header -->
    <!-- Header -->
<header>
    <div class="header-container">
        <div class="logo">
            <i class="fas fa-coffee"></i>
            <a href="../index.php">Cafe Aroma</a>
        </div>
        
        <div class="user-menu">
            <?php if (isset($_SESSION['user_id'])): ?>
               
            <?php else: ?>
                <a href="../login.php">Login</a>
                <a href="../register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
</header>
    <div class="container">
        <a href="../index.php#menu" class="back-btn"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
        
        <div class="product-detail">
            <div class="product-image">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            </div>
            
            <div class="product-info">
                <h1><?php echo $product['name']; ?></h1>
                
                <div class="product-meta">
                    <span class="product-category"><?php echo $product['category']; ?></span>
                    <span class="product-rating">
                        <i class="fas fa-star"></i> <?php echo $product['rating']; ?>
                    </span>
                </div>
                
                <span class="price"><?php echo $product['price']; ?></span>
                <p class="description"><?php echo $product['description']; ?></p>
                
                <div class="details">
                    <h3>Detail Produk</h3>
                    <p><?php echo $product['details']; ?></p>
                </div>
                
                <a href="pesan.php?id=<?php echo $product_id; ?>" class="btn">
    <i class="fas fa-shopping-cart"></i> Pesan Sekarang
</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-col">
                <h3>Tentang</h3>
                <p>Cafe Aroma adalah tempat yang sempurna untuk menikmati kopi berkualitas tinggi dan makanan lezat di suasana yang nyaman.</p>
            </div>
            
            <div class="footer-col">
                <h3>Jam Buka</h3>
                <p>Senin - Jumat: 07:00 - 22:00</p>
                <p>Sabtu - Minggu: 08:00 - 23:00</p>
            </div>
            
            <div class="footer-col">
                <h3>Kontak</h3>
                <p><i class="fas fa-map-marker-alt"></i> Jl. Raya Cafe No. 123, Jakarta</p>
                <p><i class="fas fa-phone"></i> (021) 1234567</p>
                <p><i class="fas fa-envelope"></i> info@cafearoma.com</p>
            </div>
            
            <div class="footer-col">
                <h3>Media Sosial</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
        
        <div class="copyright">
            <p>&copy; <?php echo date('Y'); ?> Cafe Aroma. All Rights Reserved.</p>
        </div>
    </footer>

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