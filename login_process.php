<?php
session_start();
require 'db.php';

/* Prevent direct access */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

/* Fetch & sanitize input */
$name = trim($_POST['name'] ?? '');
$role = $_POST['role'] ?? '';
$password = $_POST['password'] ?? '';

if ($name === '' || $role === '' || $password === '') {
    echo "<script>
        alert('All fields are required');
        window.location.href='login.php';
    </script>";
    exit;
}

/* Encrypt password */
$password = md5($password);

/* Check user */
$stmt = $conn->prepare(
    "SELECT * FROM users WHERE name=? AND role=? AND password=?"
);
$stmt->bind_param("sss", $name, $role, $password);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 1) {
    $user = $res->fetch_assoc();

    $_SESSION['user'] = $user;
    $_SESSION['role'] = $user['role'];

    /* Redirect by role */
    if ($user['role'] === 'Admin') {
        header("Location: admin_dashboard.php");
    } elseif ($user['role'] === 'Employee') {
        header("Location: employee_dashboard.php");
    } else {
        header("Location: user_bills.php");
    }
    exit;
}

/* Login failed */
echo "<script>
    alert('Invalid name, role, or password');
    window.location.href='login.php';
</script>";
exit;
