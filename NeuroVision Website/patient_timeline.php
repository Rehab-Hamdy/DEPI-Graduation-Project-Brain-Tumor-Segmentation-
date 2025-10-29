<?php
include 'db_connect.php'; 
include 'patient_nav.php'; 

session_start();

if (isset($_SESSION['patient_id'])) {
    $patient_id = $_SESSION['patient_id'];
} else {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM scans WHERE patient_id = ? ORDER BY date ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Segmentation Timeline</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #b4e4f9, #d3d9db);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin-top: 40px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .timeline-item {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s;
        }
        .timeline-item:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        strong {
            color: #2980b9;
        }
        img {
            max-width: 300px;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }
        .no-data {
            text-align: center;
            color: #7f8c8d;
            font-size: 18px;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Segmentation Timeline</h2>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($scan = $result->fetch_assoc()): ?>
            <div class="timeline-item">
                <p><strong>Date:</strong> <?php echo htmlspecialchars($scan['date']); ?></p>
                <p><strong>Diagnosis:</strong> <?php echo $scan['diagnosis'] == 1 ? 'Tumor' : 'No Tumor'; ?></p>
                <p><strong>Doctor's Note:</strong> <?php echo htmlspecialchars($scan['note']); ?></p>
                <div>
                    <strong>Segmentation Image:</strong>
                    <img src="<?php echo htmlspecialchars($scan['mask_image']); ?>" alt="Segmentation Image">
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="no-data">No segmentation data available for this patient.</p>
    <?php endif; ?>
</div>
</body>
</html>
