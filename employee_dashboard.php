<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Employee') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Employee Dashboard</title>

<style>
body{
    background:linear-gradient(135deg,#134e5e,#71b280);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Poppins;
}
.card{
    background:white;
    width:400px;
    padding:30px;
    border-radius:16px;
    box-shadow:0 25px 60px rgba(0,0,0,.35);
}
h2{text-align:center;margin-bottom:25px;}
a{
    display:block;
    text-align:center;
    padding:14px;
    margin:12px 0;
    background:#16a085;
    color:white;
    text-decoration:none;
    border-radius:10px;
}
.logout{background:#c0392b;}
</style>
</head>
<body>

<div class="card">
<h2>Employee Dashboard</h2>

<a href="generate_bill_form.php">Generate Bill</a>
<a class="logout" href="logout.php">Logout</a>
</div>

</body>
</html>
