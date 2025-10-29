<?php include 'doctor_nav.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MRI Segmentation</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <style>
        body {
            background: linear-gradient(to right, #b4e4f9, #d3d9db);
            font-family: Arial, sans-serif; 
        }
        .container {
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
        }
        .form-control, .btn {
            border-radius: 5px; 
        }
        .form-label {
            font-weight: bold;
        }
        h1 {
            color: #007BFF; 
            margin-bottom: 20px; 
        }
        
        .datepicker {
            background-color: #fff; 
            border: 1px solid #007BFF; 
            border-radius: 5px;
            padding: 10px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
        }
        .datepicker table {
            width: 100%;
        }
        .datepicker th {
            background-color: #007BFF;
            color: #fff; 
            padding: 10px;
        }
        .datepicker td {
            text-align: center;
            padding: 8px;
            cursor: pointer;
        }
        .datepicker td:hover {
            background-color: #007BFF; 
            color: #fff; 
        }
        .datepicker td.active {
            background-color: #0056b3; 
            color: #fff; 
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>MRI Segmentation</h1> 

        <form action="process_image.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="patientSelect" class="form-label">Select Patient:</label>
                <select id="patientSelect" name="patient_id" class="form-select" required>
                    <?php
                    require 'db_connect.php';

                    $sql = "SELECT * FROM patient";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['name']} (ID: {$row['id']})</option>";
                        }
                    } else {
                        echo "<option>No patients found.</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="scanDate" class="form-label">Scan Date:</label>
                <input type="text" class="form-control" id="scanDate" name="scan_date" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Choose an MRI image (.tif):</label>
                <input type="file" name="image" id="image" accept=".tif" required>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label"></label>
                <textarea id="note" name="note" class="form-control" rows="3" style="display: none;"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Segment Image</button>
        </form>

        <div id="maskResult" class="mt-4"></div>
    </div>

    <script>
        $(document).ready(function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); 
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            $('#scanDate').val(today); 

            $('#scanDate').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });
    </script>
</body>
</html>
