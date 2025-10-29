<?php include 'doctor_nav.php'; ?>
<?php
include 'db_connect.php';

$last_scan_sql = "SELECT patient_id, MAX(date) AS last_scan_date, MAX(diagnosis) AS last_diagnosis
                FROM scans
                GROUP BY patient_id";
$last_scan_result = $conn->query($last_scan_sql);

$tumor_count = 0;
$non_tumor_count = 0;

if ($last_scan_result) {
    while ($row = $last_scan_result->fetch_assoc()) {
        if ($row['last_diagnosis'] == 1) {
            $tumor_count++;
        } else {
            $non_tumor_count++;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Overall Patient Analysis</title>
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
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Overall Patient Analysis</h2>

    <p>Total Number Of Patients: <?php echo $tumor_count + $non_tumor_count; ?></p>
    <p>Patients with Tumor Cases: <?php echo $tumor_count; ?></p>
    <p>Patients without Tumor Cases: <?php echo $non_tumor_count; ?></p>

    <div style="width: 60%; margin: auto;">
        <canvas id="patientsChart"></canvas>
    </div>
</div>

<script>
    const tumorCount = <?php echo $tumor_count; ?>;
    const nonTumorCount = <?php echo $non_tumor_count; ?>;

    const ctx = document.getElementById('patientsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Patients with Tumor', 'Patients without Tumor'],
            datasets: [{
                label: 'Number of Patients',
                data: [tumorCount, nonTumorCount],
                backgroundColor: ['#f55a5a', '#007BFF'],
                borderColor: ['#f55a5a', '#0056b3'],    
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Patients'
                    },
                    ticks: {
                        stepSize: 1, 
                        callback: function(value) {
                            return Number.isInteger(value) ? value : ''; 
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
</body>
</html>
