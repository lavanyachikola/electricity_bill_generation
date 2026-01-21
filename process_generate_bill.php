<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Employee') {
    die("Access denied");
}

require 'db.php';

$service_number = $_POST['service_number'] ?? '';
$current = isset($_POST['current_reading']) ? (int)$_POST['current_reading'] : null;

if ($service_number === '' || $current === null) {
    die("Invalid input");
}


$service_number = trim(strtolower($service_number));

$stmt = $conn->prepare(
    "SELECT * FROM users WHERE service_number = ? AND role = 'User'"
);
$stmt->bind_param("s", $service_number);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    die("No registered user found");
}

$user = $res->fetch_assoc();

$stmt2 = $conn->prepare(
    "SELECT current_reading 
     FROM meter_readings 
     WHERE service_number = ?
     ORDER BY reading_date DESC
     LIMIT 1"
);
$stmt2->bind_param("s", $service_number);
$stmt2->execute();
$rres = $stmt2->get_result();

if ($rres->num_rows === 0) {
    $previous = 0;
    $is_first = true;
} else {
    $previous = (int)$rres->fetch_assoc()['current_reading'];
    $is_first = false;
}

if ($current < $previous) {
    die("Invalid reading");
}

$units = $current - $previous;

/* BILL CALCULATION */
if ($is_first) {
    $bill_amount = 0;
} elseif ($units == 0) {
    $bill_amount = 20;
} else {
    $rates = [
        'Household' => 5,
        'Commercial' => 10,
        'Industry' => 15
    ];
    $bill_amount = $units * ($rates[$user['category']] ?? 5);
}

$stmt3 = $conn->prepare(
    "SELECT COALESCE(SUM(total_amount),0) AS due
     FROM bills
     WHERE service_number = ? AND status = 'Unpaid'"
);
$stmt3->bind_param("s", $service_number);
$stmt3->execute();
$prev_due = (int)$stmt3->get_result()->fetch_assoc()['due'];

$total_amount = $bill_amount + $prev_due;

$stmt4 = $conn->prepare(
    "INSERT INTO meter_readings
     (service_number, previous_reading, current_reading, reading_date)
     VALUES (?, ?, ?, CURDATE())"
);
$stmt4->bind_param("sii", $service_number, $previous, $current);
$stmt4->execute();

$bill_number = rand(1000, 9999);

$stmt5 = $conn->prepare(
    "INSERT INTO bills
     (bill_number, service_number, previous_reading, current_reading,
      units_used, bill_amount, previous_due, total_amount,
      bill_date, due_date, status)
     VALUES
     (?, ?, ?, ?, ?, ?, ?, ?, CURDATE(),
      DATE_ADD(CURDATE(), INTERVAL 10 DAY), 'Unpaid')"
);

$stmt5->bind_param(
    "siididdd",
    $bill_number,
    $service_number,
    $previous,
    $current,
    $units,
    $bill_amount,
    $prev_due,
    $total_amount
);

$stmt5->execute();

echo "Bill generated successfully";
