<?php
$conn = new mysqli("localhost", "root", "", "electricity_bill_system");
if ($conn->connect_error) {
    die("Database connection failed");
}
?>
