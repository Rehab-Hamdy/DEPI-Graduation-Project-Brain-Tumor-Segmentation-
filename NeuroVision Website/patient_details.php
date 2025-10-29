<?php
include 'db_connect.php';

$patient_id = $_GET['patient_id'] ?? null;

if ($patient_id) {
    $sql = "SELECT * FROM patient WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();

    if ($patient) {
        $scan_sql = "SELECT * FROM scans WHERE patient_id = ? ORDER BY date DESC";
        $scan_stmt = $conn->prepare($scan_sql);
        $scan_stmt->bind_param("i", $patient_id);
        $scan_stmt->execute();
        $scans = $scan_stmt->get_result();
    } else {
        echo "<p>Patient not found.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p>No patient ID provided.</p>";
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <title>Patient Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
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
        .back-arrow {
            display: inline-flex;
            align-items: center;
            color: #0463fa;
            text-decoration: none;
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .back-arrow i {
            margin-right: 8px;
        }
        .back-arrow:hover {
            color: #034fc8;
            text-decoration: underline;
        }
        h2, h3 {
            color: #0463fa;
        }
        .timeline {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }
        .timeline-item {
            display: flex;
            align-items: start;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f1f9ff;
            border: 1px solid #d1e9ff;
            border-radius: 8px;
            position: relative;
        }
        .timeline-item:before {
            content: "";
            position: absolute;
            left: -8px;
            top: 20px;
            width: 10px;
            height: 10px;
            background: #0463fa;
            border-radius: 50%;
        }
        .timeline-date {
            font-weight: bold;
            margin-right: 20px;
            color: #777;
            min-width: 150px;
        }
        .timeline-image {
            width: 120px;
            height: auto;
            margin-right: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .timeline-content {
            flex-grow: 1;
        }
        .timeline-content p {
            margin: 0;
            color: #333;
        }
        .note {
            margin-top: 10px;
            font-style: italic;
            color: #555;
        }
        .add-note-form {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
        .add-note-form textarea {
            resize: none;
            border-radius: 5px;
            flex: 1;
        }
        .add-note-form button {
            background-color: #0463fa;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .add-note-form button:hover {
            background-color: #034fc8;
        }
        textarea[name="note"] {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            resize: vertical;
            min-height: 100px;
        }

        button.btn-primary {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #0463fa;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s;
        }

        button.btn-primary:hover {
            background-color: #034fc8;
            transform: scale(1.05);
        }

    </style>
</head>
<body>
<div class="container mt-4">
    <a href="patient_registry.php" class="btn btn-secondary mb-3" style="background-color: #ccc; border: #777; color: #034fc8; font-weight: bold;"><i class="fa fa-arrow-left text-primary fs-4"></i> Back to Patient Registry</a>


    <h2>Patient Details</h2>
    <p><strong>ID:</strong> <?php echo htmlspecialchars($patient['id']); ?></p>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($patient['name']); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($patient['phone_number']); ?></p>
    <p><strong>Age:</strong> <?php echo htmlspecialchars($patient['age']); ?></p>

    <h3 class="mt-4">Segmentation Timeline</h3>

    <?php if ($scans->num_rows > 0): ?>
        <ul class="timeline">
            <?php while ($scan = $scans->fetch_assoc()): ?>
                <li class="timeline-item">
                    <div class="timeline-date">
                        <?php echo date('F j, Y, g:i a', strtotime($scan['date'])); ?>
                    </div>
                    <img src="<?php echo htmlspecialchars($scan['mask_image']); ?>" alt="Segmentation Mask" class="timeline-image">
                    <div class="timeline-content">
                        <p><strong>Diagnosis:</strong> <?php echo $scan['diagnosis'] ? 'Tumor Detected' : 'No Tumor'; ?></p>
                        <?php if ($scan['note']): ?>
                            <p class="note"><strong>Note:</strong> <?php echo htmlspecialchars($scan['note']); ?></p>
                        <?php else: ?>
                            <form action="add_note.php" method="post">
                                <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
                                <input type="hidden" name="scan_id" value="<?php echo $scan['id']; ?>"> 
                                <textarea name="note" placeholder="Enter your note here..." required></textarea>
                                <button type="submit" class="btn btn-primary">Add Note</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No scans found for this patient.</p>
    <?php endif; ?>
</div>
</body>
</html>
