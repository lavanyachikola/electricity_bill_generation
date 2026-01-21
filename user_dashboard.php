<?php
session_start();
include "db.php";
$svc=$_SESSION['user']['service_number'];
$res=$conn->query("SELECT * FROM electricity_bills WHERE service_number='$svc'");
?>
<!DOCTYPE html>
<html>
<head>
<title>User Bills</title>

<style>
body{
    background:linear-gradient(135deg,#232526,#414345);
    min-height:100vh;
    font-family:Poppins;
    padding:40px;
}
.card{
    max-width:800px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 25px 60px rgba(0,0,0,.4);
}
.bill{
    background:#f4f9ff;
    border-left:6px solid #3498db;
    padding:15px;
    margin-bottom:15px;
    border-radius:10px;
}
.amount{
    font-size:20px;
    color:#2c5364;
    font-weight:bold;
}
.logout{
    display:block;
    margin-top:20px;
    padding:12px;
    text-align:center;
    background:#e74c3c;
    color:white;
    text-decoration:none;
    border-radius:8px;
}
</style>

</head>
<body>

<div class="card">
<h2>Your Electricity Bills</h2>

<?php while($b=$res->fetch_assoc()){ ?>
<div class="bill">
<p><b>Meter:</b> <?= $b['meter_number'] ?></p>
<p><b>Units:</b> <?= $b['units'] ?></p>
<p><b>Date:</b> <?= $b['bill_date'] ?></p>
<p class="amount">₹ <?= $b['amount'] ?></p>
</div>
<?php } ?>

<a class="logout" href="logout.php">Logout</a>
</div>

</body>
</html>
