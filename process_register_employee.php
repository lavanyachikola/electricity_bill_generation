<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

/* ONLY ADMIN CAN REGISTER EMPLOYEE */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit;
}

require 'db.php';

$success = false;
$error_msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $household_name = trim($_POST['household_name']);
    $house_number = trim($_POST['house_number']);
    $pin_number = trim($_POST['pin_number']);
    $phone_number = trim($_POST['phone_number']);
    $service_number = trim($_POST['service_number']);
    $password = md5($_POST['password']);

    /* Fixed values */
    $category = 'Household';
    $role = 'Employee';
    $meter_number = "EMP_" . $service_number;

    /* CHECK DUPLICATE SERVICE NUMBER */
    $check = $conn->prepare(
        "SELECT id FROM users WHERE service_number=?"
    );
    $check->bind_param("s", $service_number);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $error_msg = "Service number already exists";
    } else {

        $stmt = $conn->prepare(
            "INSERT INTO users 
            (name, household_name, house_number, pin_number, phone_number,
             service_number, meter_number, category, role, password)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        if ($stmt) {
            $stmt->bind_param(
                "ssssssssss",
                $name,
                $household_name,
                $house_number,
                $pin_number,
                $phone_number,
                $service_number,
                $meter_number,
                $category,
                $role,
                $password
            );

            if ($stmt->execute()) {
                $success = true;
            } else {
                $error_msg = $stmt->error;
            }
        } else {
            $error_msg = $conn->error;
        }
    }

} else {
    header("Location: register_employee.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register Employee</title>
</head>
<body>

<?php if ($success): ?>
    <h2>✅ Employee Registered Successfully</h2>
    <p>Name: <?= htmlspecialchars($name) ?></p>
    <a href="admin_dashboard.php">Back to Dashboard</a>
<?php else: ?>
    <h2 style="color:red;">❌ Registration Failed</h2>
    <p><?= htmlspecialchars($error_msg) ?></p>
    <a href="register_employee.php">Try Again</a>
<?php endif; ?>

</body>
</html>
