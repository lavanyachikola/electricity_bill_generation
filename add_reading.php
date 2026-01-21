<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'Employee'){
    die("Access denied.");
}

require 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Meter Reading</title>
    <style>
        body { font-family: Arial; text-align: center; background: #f2f2f2; margin-top: 50px; }
        .box { background: white; width: 400px; margin: auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px gray; }
        input, button { width: 90%; margin: 10px 0; padding: 8px; }
        button { background: #4CAF50; color: white; border: none; cursor: pointer; border-radius: 5px; }
        button:hover { background: #45a049; }
    </style>
</head>
<body>
<div class="box">
    <h2>Add Meter Reading</h2>
    <form action="process_add_reading.php" method="POST">
        <input type="text" name="service_number" placeholder="Service Number" required><br>
        <input type="number" name="previous_reading" placeholder="Previous Meter Reading" required><br>
        <input type="number" name="current_reading" placeholder="Current Meter Reading" required><br>
        <button type="submit">Submit Reading</button>
    </form>
    <a href="employee_dashboard.php">Back to Dashboard</a>
</div>
</body>
</html>
