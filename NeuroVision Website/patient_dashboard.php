<?php
session_start(); 

include 'db_connect.php';
include 'patient_nav.php';

if (isset($_SESSION['patient_id'])) {
    $patient_id = $_SESSION['patient_id'];
} else {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM scans WHERE patient_id = ? ORDER BY date DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
$latest_scan = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Latest Segmentation</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
        img {
            max-width: 300px;
            height: auto;
        }
        h2 {
            color: #2c3e50;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Latest Segmentation</h2>
    <?php if ($latest_scan): ?>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($latest_scan['date']); ?></p>
        <p><strong>Diagnosis:</strong> <?php echo $latest_scan['diagnosis'] == 1 ? 'Tumor' : 'No Tumor'; ?></p>
        <p><strong>Doctor's Note:</strong> <?php echo htmlspecialchars($latest_scan['note']); ?></p>
        <div>
            <strong>Segmentation Image:</strong>
            <img src="<?php echo htmlspecialchars($latest_scan['mask_image']); ?>" alt="Segmentation Image">
        </div>
    <?php else: ?>
        <p>No segmentation data available for this patient.</p>
    <?php endif; ?>
</div>
</body>
</html>
