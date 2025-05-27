<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simpan data pesanan (contoh sederhana)
    $order = [
        'product_id' => $_POST['product_id'],
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'customer_name' => $_POST['name'],
        'customer_phone' => $_POST['phone'],
        'customer_email' => $_POST['email'],
        'quantity' => $_POST['quantity'],
        'notes' => $_POST['notes'],
        'order_date' => date('Y-m-d H:i:s')
    ];
    
    // Simpan ke session (bisa diganti dengan database)
    $_SESSION['orders'][] = $order;
    
    // Redirect ke halaman konfirmasi
    header("Location: order_success.php?id=" . $_POST['product_id']);
    exit;
} else {
    header("Location: ../index.php");
    exit;
}