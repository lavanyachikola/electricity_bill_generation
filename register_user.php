<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Only allow Admin
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    header("Location: login.php");
    exit;
}

require 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; text-align: center; margin-top: 50px; }
        .box { background: white; width: 400px; margin: auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px gray; }
        input, select, button { width: 90%; margin: 10px 0; padding: 8px; }
        button { background: #4CAF50; color: white; border: none; cursor: pointer; border-radius: 5px; }
        button:hover { background: #45a049; }
        a { text-decoration: none; color: #333; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Register User</h2>
        <form action="process_register_user.php" method="POST">
            <input type="text" name="name" placeholder="Name (max 32 chars)" maxlength="32" required><br>
            <input type="text" name="household_name" placeholder="Household Name (max 32 chars)" maxlength="32" required><br>
            <input type="text" name="house_number" placeholder="House Number" required><br>
            <input type="text" name="pin_number" placeholder="PIN (min 6)" minlength="6" maxlength="10" required><br>
            <input type="text" name="phone_number" placeholder="Phone Number (10 digits)" maxlength="10" required><br>
            <input type="text" name="service_number" placeholder="Service Number" required><br>
            <input type="text" name="meter_number" placeholder="Meter Number" required><br>
            <select name="category" required>
                <option value="">Select Category</option>
                <option value="Household">Household</option>
                <option value="Commercial">Commercial</option>
                <option value="Industry">Industry</option>
            </select><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register User</button>
        </form>
        <br>
        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
