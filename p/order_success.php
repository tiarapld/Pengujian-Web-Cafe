<?php
session_start();
$product_id = $_GET['id'] ?? null;

if (!$product_id || empty($_SESSION['orders'])) {
    header("Location: ../index.php");
    exit;
}

$last_order = end($_SESSION['orders']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil | Cafe Aroma</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #3a2c2a;
            --secondary: #c8a97e;
            --light: #f9f5f0;
            --dark: #333;
            --success: #4CAF50;
            --background: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--background);
            color: var(--dark);
            line-height: 1.6;
            padding-top: 80px;
        }

        /* Header Styles */
        header {
            background-color: var(--primary);
            padding: 15px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            color: var(--secondary);
            font-size: 1.3rem;
        }

        .user-actions {
            display: flex;
            gap: 20px;
        }

        .user-actions a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .user-actions a:hover {
            color: var(--secondary);
        }

        /* Success Container */
        .container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            text-align: center;
        }

        .success-icon {
            color: var(--success);
            font-size: 4rem;
            margin-bottom: 1.5rem;
        }

        h1 {
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        .success-message {
            color: var(--dark);
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .order-details {
            text-align: left;
            margin: 2rem 0;
            padding: 1.5rem;
            background: var(--light);
            border-radius: 8px;
            border-left: 4px solid var(--secondary);
        }

        .order-details h3 {
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .order-details p {
            margin-bottom: 0.8rem;
            font-size: 1rem;
        }

        .order-details strong {
            color: var(--primary);
            font-weight: 600;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            min-width: 150px;
        }

        .btn-primary {
            background-color: var(--secondary);
            color: white;
        }

        .btn-primary:hover {
            background-color: #b89a6b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .btn-dark {
            background-color: var(--primary);
            color: white;
        }

        .btn-dark:hover {
            background-color: #2a211f;
            transform: translateY(-2px);
        }

        .btn i {
            margin-right: 8px;
        }

        /* Footer */
        footer {
            background-color: var(--primary);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                margin: 1rem;
                padding: 1.5rem;
            }
            
            .btn-group {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
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
          
        </div>
    </header>

    <!-- Success Content -->
    <div class="container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h1>Pesanan Berhasil Ditempatkan!</h1>
        <p class="success-message">Terima kasih atas pesanan Anda. Detail pesanan telah dikirim ke email Anda.</p>
        
        <div class="order-details">
            <h3>Detail Pesanan:</h3>
            <p><strong>Produk:</strong> <?php echo $last_order['product_name']; ?></p>
            <p><strong>Harga:</strong> <?php echo $last_order['product_price']; ?></p>
            <p><strong>Jumlah:</strong> <?php echo $last_order['quantity']; ?></p>
            <p><strong>Total:</strong> <?php 
                $price = (int)filter_var($last_order['product_price'], FILTER_SANITIZE_NUMBER_INT);
                $total = $price * $last_order['quantity'];
                echo 'Rp ' . number_format($total, 0, ',', '.');
            ?></p>
        </div>
        
        <div class="btn-group">
            <a href="../index.php" class="btn btn-primary">
                <i class="fas fa-home"></i> Ke Beranda
            </a>
            <a href="product_detail.php?id=<?php echo $product_id; ?>" class="btn btn-dark">
                <i class="fas fa-undo"></i> Pesan Lagi
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div>
            <p>&copy; <?php echo date('Y'); ?> Cafe Aroma. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>