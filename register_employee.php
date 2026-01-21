<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Only Admin allowed */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register Employee</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
            text-align: center;
            margin-top: 50px;
        }
        .box {
            background: white;
            width: 420px;
            margin: auto;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px gray;
        }
        input, button {
            width: 90%;
            margin: 10px 0;
            padding: 10px;
        }
        button {
            background: #2196F3;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        button:hover { background: #0b7dda; }
        a { text-decoration: none; color: #333; }
    </style>
</head>

<body>
<div class="box">
    <h2>Register Employee</h2>

    <form method="post" action="process_register_employee.php">

        <input type="text"
               name="name"
               placeholder="Employee Name"
               maxlength="32"
               required>

        <input type="text"
               name="household_name"
               placeholder="Department / Office Name"
               maxlength="32"
               required>

        <input type="text"
               name="house_number"
               placeholder="Office / House Number"
               required>

        <input type="text"
               name="pin_number"
               placeholder="PIN Code"
               minlength="6"
               maxlength="10"
               required>

        <input type="text"
               name="phone_number"
               placeholder="Phone Number"
               minlength="10"
               maxlength="10"
               required>

        <input type="text"
               name="service_number"
               placeholder="Employee Service Number"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <button type="submit">Register Employee</button>
    </form>

    <br>
    <a href="admin_dashboard.php">⬅ Back to Dashboard</a>
</div>
</body>
</html>
