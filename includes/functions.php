<?php

/**
 * Format number to Indian Rupee
 * Usage: echo formatRupee(5000); // Outputs: ₹5,000.00
 */
function formatRupee($amount) {
    return "₹" . number_format($amount, 2);
}

/**
 * Sanitize User Input (Prevent XSS)
 * Usage: $clean_name = sanitize($_POST['name']);
 */
function sanitize($conn, $input) {
    return htmlspecialchars(mysqli_real_escape_string($conn, trim($input)));
}

/**
 * Check if user is logged in
 */
function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit;
    }
}

/**
 * Check if user is Admin
 */
function checkAdmin() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../login.php");
        exit;
    }
}
?>