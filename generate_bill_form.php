<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Employee') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>

<h2>Generate Electricity Bill</h2>

<form method="post" action="process_generate_bill.php">
    <input type="text" name="service_number" placeholder="Service Number" required>
    <input type="number" name="current_reading" placeholder="Current Meter Reading" required>
    <button type="submit">Generate Bill</button>
</form>

<a href="employee_dashboard.php">Back</a>

</body>
</html>
