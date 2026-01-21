<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'Employee'){
    die("Access denied.");
}

require 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $service_number = $_POST['service_number'];
    $previous = $_POST['previous_reading'];
    $current = $_POST['current_reading'];

    // Insert meter reading
    $stmt = $conn->prepare("INSERT INTO meter_readings (service_number, previous_reading, current_reading, reading_date) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sdd", $service_number, $previous, $current);

    if($stmt->execute()){
        echo "<h3>Meter reading saved successfully!</h3>";
        echo "<a href='employee_dashboard.php'>Back to Dashboard</a>";
    } else {
        echo "<h3>Error: ".$stmt->error."</h3>";
        echo "<a href='add_reading.php'>Try Again</a>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: add_reading.php");
    exit;
}
?>
