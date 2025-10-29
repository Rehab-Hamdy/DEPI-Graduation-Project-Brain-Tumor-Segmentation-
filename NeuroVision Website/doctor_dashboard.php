<?php
    include 'doctor_nav.php';
?>

<?php
include 'db_connect.php';

$patients_sql = "SELECT p.id AS patient_id, p.name AS patient_name, p.age, p.phone_number, s.date AS last_scan_date, s.diagnosis
                FROM patient p
                LEFT JOIN scans s ON p.id = s.patient_id
                WHERE s.id = (SELECT MAX(id) FROM scans WHERE patient_id = p.id)
                ORDER BY p.id";
$patients_result = $conn->query($patients_sql);

$tumor_sql = "SELECT COUNT(DISTINCT patient_id) AS tumor_count FROM scans WHERE diagnosis = 1";
$tumor_result = $conn->query($tumor_sql);
$tumor_count = ($tumor_result && $tumor_result->num_rows > 0) ? $tumor_result->fetch_assoc()['tumor_count'] : 0;

$non_tumor_sql = "SELECT COUNT(DISTINCT patient_id) AS non_tumor_count 
                FROM scans WHERE patient_id NOT IN 
                (SELECT DISTINCT patient_id FROM scans WHERE diagnosis = 1)";
$non_tumor_result = $conn->query($non_tumor_sql);
$non_tumor_count = ($non_tumor_result && $non_tumor_result->num_rows > 0) ? $non_tumor_result->fetch_assoc()['non_tumor_count'] : 0;

$conn->close();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: linear-gradient(to right, #b4e4f9, #d3d9db);
            font-family: Arial, sans-serif;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        h2, h3 {
            color: #0463fa;
        }
        .patient-table th, .patient-table td {
            text-align: center;
        }
        .table {
            background-color: white; 
            border-radius: 8px; 
            overflow: hidden; 
        }
        .table th {
            background-color: #0463fa; 
            color: white;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Doctor Dashboard</h2>

    <h3>Patient Overview</h3>
    <p>Total Patients: <?php echo $tumor_count + $non_tumor_count; ?></p>
    <p>Patients with Tumor Cases: <?php echo $tumor_count; ?></p>
    <p>Patients without Tumor Cases: <?php echo $non_tumor_count; ?></p>


    <h3 class="mt-4">Recent Scans</h3>
    <table class="table table-bordered patient-table">
        <thead>
            <tr>
                <th>Patient ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Phone Number</th>
                <th>Last Scan Date</th>
                <th>Diagnosis</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($patients_result && $patients_result->num_rows > 0): ?>
                <?php while ($patient = $patients_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($patient['patient_id']); ?></td>
                        <td><?php echo htmlspecialchars($patient['patient_name']); ?></td>
                        <td><?php echo htmlspecialchars($patient['age']); ?></td>
                        <td><?php echo htmlspecialchars($patient['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($patient['last_scan_date']); ?></td>
                        <td><?php echo $patient['diagnosis'] ? 'Tumor Detected' : 'No Tumor'; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No recent scans found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
