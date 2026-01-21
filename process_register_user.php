<?php
session_start();
if($_SESSION['role'] != 'Admin') { 
    header("Location: login.php"); 
    exit; 
}

require 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $household_name = $_POST['household_name'];
    $house_number = $_POST['house_number'];
    $pin_number = $_POST['pin_number'];
    $phone_number = $_POST['phone_number'];
    $service_number = $_POST['service_number'];
    $meter_number = $_POST['meter_number'];
    $category = $_POST['category'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("INSERT INTO users (name, household_name, house_number, pin_number, phone_number, service_number, meter_number, category, role, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'User', ?)");
    $stmt->bind_param("sssssssss", $name, $household_name, $house_number, $pin_number, $phone_number, $service_number, $meter_number, $category, $password);

    if($stmt->execute()){
        $success = true;
    } else {
        $success = false;
        $error_msg = $stmt->error;
    }
} else {
    header("Location: register_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }
        h2 {
            color: #0072ff;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            color: #333;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #0072ff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover { background: #005bb5; }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="box">
        <?php if($success): ?>
            <h2>User Registered Successfully!</h2>
            <p>The user <strong><?= htmlspecialchars($name) ?></strong> has been added.</p>
            <a href="admin_dashboard.php">Back to Dashboard</a>
        <?php else: ?>
            <h2 class="error">Error Registering User!</h2>
            <p><?= htmlspecialchars($error_msg) ?></p>
            <a href="register_user.php">Try Again</a>
        <?php endif; ?>
    </div>
</body>
</html>
