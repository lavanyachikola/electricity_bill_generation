<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit;
}

require 'db.php';

/* JOIN bills + users */
$sql = "
SELECT 
    b.bill_number,
    b.service_number,
    u.name AS customer_name,
    u.meter_number,
    b.previous_reading,
    b.current_reading,
    b.units_used,
    b.total_amount,
    b.bill_date,
    b.due_date,
    b.status
FROM bills b
JOIN users u ON b.service_number = u.service_number
ORDER BY b.bill_date DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>All Bills</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #0072ff;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: #0072ff;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:hover {
            background: #e0f0ff;
        }
        a.back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #0072ff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a.back:hover { background: #005bb5; }
    </style>
</head>
<body>

<h2>All Bills</h2>

<?php if ($result && $result->num_rows > 0): ?>
<table>
    <tr>
        <th>Bill No</th>
        <th>Service No</th>
        <th>Customer Name</th>
        <th>Meter No</th>
        <th>Previous</th>
        <th>Current</th>
        <th>Units</th>
        <th>Total Amount</th>
        <th>Bill Date</th>
        <th>Due Date</th>
        <th>Status</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['bill_number']) ?></td>
        <td><?= htmlspecialchars($row['service_number']) ?></td>
        <td><?= htmlspecialchars($row['customer_name']) ?></td>
        <td><?= htmlspecialchars($row['meter_number']) ?></td>
        <td><?= htmlspecialchars($row['previous_reading']) ?></td>
        <td><?= htmlspecialchars($row['current_reading']) ?></td>
        <td><?= htmlspecialchars($row['units_used']) ?></td>
        <td>₹<?= htmlspecialchars($row['total_amount']) ?></td>
        <td><?= htmlspecialchars($row['bill_date']) ?></td>
        <td><?= htmlspecialchars($row['due_date']) ?></td>
        <td><?= htmlspecialchars($row['status']) ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php else: ?>
<p style="text-align:center;">No bills found.</p>
<?php endif; ?>

<div style="text-align:center;">
    <a href="admin_dashboard.php" class="back">Back to Dashboard</a>
</div>

</body>
</html>
