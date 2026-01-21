<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin'){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>
body{
    background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:'Poppins',Arial;
}
.card{
    background:white;
    width:420px;
    padding:30px;
    border-radius:18px;
    box-shadow:0 25px 60px rgba(0,0,0,.35);
}
h2{text-align:center;margin-bottom:25px;}
a{
    display:block;
    text-align:center;
    padding:14px;
    margin:12px 0;
    background:linear-gradient(135deg,#36d1dc,#5b86e5);
    color:white;
    text-decoration:none;
    border-radius:10px;
}
a:hover{transform:scale(1.03);}
.logout{background:#e74c3c;}
</style>

</head>
<body>

<div class="card">
<h2>Admin Dashboard</h2>

<a href="register_user.php">Register User</a>
<a href="register_employee.php">Register Employee</a>
<a href="view_all_bills.php">View All Bills</a>
<a class="logout" href="logout.php">Logout</a>
</div>

</body>
</html>
