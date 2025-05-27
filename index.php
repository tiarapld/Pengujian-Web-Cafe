<?php
session_start();
$page_title = "Selamat Datang di Cafe Kami";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
        
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

        /* Global Styles */
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
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Styles */
        header {
            background-color: var(--primary-color);
            color: var(--light-color);
            padding: 20px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px var(--shadow-color);
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 10px;
            color: var(--secondary-color);
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 30px;
        }
        
        nav ul li a {
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }
        
        nav ul li a:hover {
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
        
        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(58, 44, 42, 0.7), rgba(58, 44, 42, 0.7)), 
                        url('https://images.unsplash.com/photo-1445116572660-236099ec97a0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            text-align: center;
            color: #fff;
            padding-top: 80px;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            color: var(--secondary-color);
        }
        
        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
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
        }
        
        .btn:hover {
            background-color: #b89a6b;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px var(--shadow-color);
        }
        
        /* Menu Section Styles */
.menu-section {
    padding: 80px 0;
    background-color: var(--menu-bg);
}

.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.menu-item {
    perspective: 1000px;
}

.menu-item-inner {
    position: relative;
    transition: all 0.5s ease;
    transform-style: preserve-3d;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.menu-item:hover .menu-item-inner {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.menu-link {
    display: block;
    color: inherit;
    text-decoration: none;
}

.menu-img {
    height: 220px;
    position: relative;
    overflow: hidden;
}

.menu-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.menu-item:hover .menu-img img {
    transform: scale(1.05);
}

.menu-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(58, 44, 42, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.menu-item:hover .menu-overlay {
    opacity: 1;
}

.view-details {
    color: white;
    font-weight: 600;
    padding: 8px 20px;
    border: 2px solid white;
    border-radius: 30px;
    transition: all 0.3s;
}

.menu-item:hover .view-details {
    transform: translateY(0);
}

.menu-content {
    padding: 20px;
    background-color: var(--menu-item-bg);
}

.menu-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.menu-header h3 {
    font-size: 20px;
    color: var(--primary-color);
    margin: 0;
}

.price {
    font-size: 18px;
    font-weight: 700;
    color: var(--secondary-color);
}

.menu-description {
    color: var(--text-muted);
    font-size: 14px;
    margin-bottom: 15px;
    line-height: 1.5;
}

.menu-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
}

.menu-category {
    background-color: var(--secondary-color);
    color: var(--primary-color);
    padding: 3px 10px;
    border-radius: 20px;
    font-weight: 600;
}

.menu-rating {
    color: var(--secondary-color);
    font-weight: 600;
}

.menu-rating i {
    color: #ffc107;
    margin-right: 3px;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .menu-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
    
    .menu-img {
        height: 180px;
    }
}
        /* About Section */
        .about-section {
            padding: 80px 0;
            background-color: var(--section-bg);
        }
        
        .about-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }
        
        .about-img img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 5px 15px var(--shadow-color);
        }
        
        .about-content h2 {
            font-size: 36px;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .about-content p {
            margin-bottom: 15px;
            color: var(--text-muted);
        }
        
        /* Footer */
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
        }
        
        /* Dark Mode Toggle Button */
        #toggleModeBtn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 100;
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 10px var(--shadow-color);
        }
        
        #toggleModeBtn:hover {
            background-color: #b89a6b;
        }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                text-align: center;
            }
            
            nav ul {
                margin-top: 20px;
                flex-direction: column;
                align-items: center;
            }
            
            nav ul li {
                margin: 10px 0;
            }
            
            .auth-buttons {
                margin-top: 20px;
            }
            
            .hero h1 {
                font-size: 36px;
            }
            
            .hero p {
                font-size: 18px;
            }
            
            .about-container {
                grid-template-columns: 1fr;
            }
            
            .about-img {
                order: -1;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <i class="fas fa-coffee"></i>
                <span>Cafe Aroma</span>
            </div>
            
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#about">Tentang </a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
            </nav>
            
            <div class="auth-buttons">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="d/dashboard.php" class="btn">Profile</a>
                    <a href="logout.php" class="login">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="login">Login</a>
                    <a href="register.php" class="register">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
        <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Selamat Datang di Cafe Kami</h1>
            <p>Temukan kenikmatan dalam setiap tegukan kopi berkualitas tinggi dan hidangan lezat di tempat yang nyaman</p>
            <a href="#menu" class="btn">Lihat Menu</a>
        </div>
    </section>
    <!-- Menu Section -->
<section class="menu-section" id="menu">
    <div class="container">
        <div class="section-title">
            <h2>Menu Spesial Kami</h2>
            <p>Nikmati berbagai pilihan minuman dan makanan lezat yang dibuat dengan bahan-bahan terbaik</p>
        </div>
        
        <div class="menu-grid">
            <!-- Menu Item 1 -->
            <div class="menu-item">
                <div class="menu-item-inner">
                    <a href="p/product_detail.php?id=1" class="menu-link">
                        <div class="menu-img">
                            <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Espresso">
                            <div class="menu-overlay">
                                <span class="view-details">Lihat Detail</span>
                            </div>
                        </div>
                        <div class="menu-content">
                            <div class="menu-header">
                                <h3>Espresso</h3>
                                <span class="price">Rp 25.000</span>
                            </div>
                            <p class="menu-description">Kopi murni dengan rasa kuat dan crema yang sempurna</p>
                            <div class="menu-footer">
                                <span class="menu-category">Minuman Panas</span>
                                <span class="menu-rating">
                                    <i class="fas fa-star"></i> 4.8
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Menu Item 2 -->
            <div class="menu-item">
                <div class="menu-item-inner">
                    <a href="p/product_detail.php?id=2" class="menu-link">
                        <div class="menu-img">
                            <img src="https://images.unsplash.com/photo-1551024506-0bccd828d307?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Cappuccino">
                            <div class="menu-overlay">
                                <span class="view-details">Lihat Detail</span>
                            </div>
                        </div>
                        <div class="menu-content">
                            <div class="menu-header">
                                <h3>Cappuccino</h3>
                                <span class="price">Rp 30.000</span>
                            </div>
                            <p class="menu-description">Perpaduan sempurna espresso, susu steamed, dan foam</p>
                            <div class="menu-footer">
                                <span class="menu-category">Minuman Panas</span>
                                <span class="menu-rating">
                                    <i class="fas fa-star"></i> 4.9
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Menu Item 3 -->
            <div class="menu-item">
                <div class="menu-item-inner">
                    <a href="p/product_detail.php?id=3" class="menu-link">
                        <div class="menu-img">
                            <img src="https://images.unsplash.com/photo-1568649929103-28ffbefaca1e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Latte Art">
                            <div class="menu-overlay">
                                <span class="view-details">Lihat Detail</span>
                            </div>
                        </div>
                        <div class="menu-content">
                            <div class="menu-header">
                                <h3>Latte Art</h3>
                                <span class="price">Rp 35.000</span>
                            </div>
                            <p class="menu-description">Espresso dengan susu steamed dan seni latte yang indah</p>
                            <div class="menu-footer">
                                <span class="menu-category">Minuman Panas</span>
                                <span class="menu-rating">
                                    <i class="fas fa-star"></i> 4.7
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Menu Item 4 -->
            <div class="menu-item">
                <div class="menu-item-inner">
                    <a href="p/product_detail.php?id=4" class="menu-link">
                        <div class="menu-img">
                            <img src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Avocado Toast">
                            <div class="menu-overlay">
                                <span class="view-details">Lihat Detail</span>
                            </div>
                        </div>
                        <div class="menu-content">
                            <div class="menu-header">
                                <h3>Avocado Toast</h3>
                                <span class="price">Rp 45.000</span>
                            </div>
                            <p class="menu-description">Roti panggang dengan alpukat tumbuk, telur, dan bumbu rahasia</p>
                            <div class="menu-footer">
                                <span class="menu-category">Makanan</span>
                                <span class="menu-rating">
                                    <i class="fas fa-star"></i> 4.6
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Menu Item 5 -->
            <div class="menu-item">
                <div class="menu-item-inner">
                    <a href="p/product_detail.php?id=5" class="menu-link">
                        <div class="menu-img">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Salad Bowl">
                            <div class="menu-overlay">
                                <span class="view-details">Lihat Detail</span>
                            </div>
                        </div>
                        <div class="menu-content">
                            <div class="menu-header">
                                <h3>Salad Bowl</h3>
                                <span class="price">Rp 40.000</span>
                            </div>
                            <p class="menu-description">Campuran sayuran segar dengan dressing khusus</p>
                            <div class="menu-footer">
                                <span class="menu-category">Makanan Sehat</span>
                                <span class="menu-rating">
                                    <i class="fas fa-star"></i> 4.5
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Menu Item 6 -->
            <div class="menu-item">
                <div class="menu-item-inner">
                    <a href="p/product_detail.php?id=6" class="menu-link">
                        <div class="menu-img">
                            <img src="https://images.unsplash.com/photo-1563805042-7684c019e1cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Croissant">
                            <div class="menu-overlay">
                                <span class="view-details">Lihat Detail</span>
                            </div>
                        </div>
                        <div class="menu-content">
                            <div class="menu-header">
                                <h3>Croissant</h3>
                                <span class="price">Rp 25.000</span>
                            </div>
                            <p class="menu-description">Croissant renyah dengan isian coklat atau keju</p>
                            <div class="menu-footer">
                                <span class="menu-category">Snack</span>
                                <span class="menu-rating">
                                    <i class="fas fa-star"></i> 4.4
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
    
    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container about-container">
            <div class="about-content">
                <h2>Tentang Cafe Kami</h2>
                <p>Cafe Aroma didirikan pada tahun 2010 dengan misi memberikan pengalaman ngopi yang berbeda. Kami menggunakan biji kopi pilihan dari petani lokal yang diolah dengan teknik roasting khusus.</p>
                <p>Selain kopi, kami juga menyajikan berbagai makanan sehat dan lezat yang cocok menemani waktu santai Anda. Suasana cafe yang nyaman membuat Anda betah berlama-lama.</p>
                <p>Kami berkomitmen untuk memberikan pelayanan terbaik dan kualitas produk yang konsisten kepada setiap pelanggan.</p>
                <a href="#contact" class="btn">Hubungi Kami</a>
            </div>
            
            <div class="about-img">
                <img src="https://images.unsplash.com/photo-1445116572660-236099ec97a0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Interior Cafe">
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer id="contact">
        <div class="container">
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
        </div>
    </footer>
    
    <button id="toggleModeBtn" title="Mode">
        <i class="fas fa-moon"></i> Mode Gelap
    </button>

    <script>
        const toggleBtn = document.getElementById("toggleModeBtn");
        const body = document.body;
        const icon = toggleBtn.querySelector("i");

        // Cek preferensi mode dari localStorage
        const currentMode = localStorage.getItem("mode") || "light";
        
        // Terapkan mode saat halaman dimuat
        if (currentMode === "dark") {
            body.classList.add("dark-mode");
            icon.classList.replace("fa-moon", "fa-sun");
            toggleBtn.innerHTML = '<i class="fas fa-sun"></i> Mode Terang';
        }

        // Fungsi untuk toggle mode
        function toggleDarkMode() {
            body.classList.toggle("dark-mode");
            
            if (body.classList.contains("dark-mode")) {
                localStorage.setItem("mode", "dark");
                icon.classList.replace("fa-moon", "fa-sun");
                toggleBtn.innerHTML = '<i class="fas fa-sun"></i> Mode Terang';
            } else {
                localStorage.setItem("mode", "light");
                icon.classList.replace("fa-sun", "fa-moon");
                toggleBtn.innerHTML = '<i class="fas fa-moon"></i> Mode Gelap';
            }
        }

        // Event listener untuk tombol toggle
        toggleBtn.addEventListener("click", toggleDarkMode);
    </script>
</body>
</html>