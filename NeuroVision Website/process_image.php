<?php require 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MRI Segmentation Results</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #b4e4f9, #d3d9db);
            font-family: Arial, sans-serif;
            color: #333;
            padding: 20px;
        }

        .container { 
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 800px;
            margin: auto;
        }

        h1, h2 {
            color: #007BFF;
            margin-bottom: 15px;
        }

        .error-message {
            color: #FF0000;
            font-weight: bold;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            margin-top: 15px;
        }

        .btn {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="file"], .form-control {
            border-radius: 5px;
            border: 1px solid #007BFF;
            padding: 10px;
        }

        input[type="file"]:hover, .form-control:hover {
            border-color: #0056b3;
        }

        .results {
            margin-top: 20px;
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
    <div class="container">
    <a href="mri_segmentation.php" class="btn btn-secondary mb-3" style="background-color: #ccc; border: #777; color: #034fc8; font-weight: bold;"><i class="fa fa-arrow-left text-primary fs-4"></i> Back</a>
        <h1>MRI Segmentation Results</h1>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
            $flask_url = 'http://127.0.0.1:5000/process_image';

            $ch = curl_init($flask_url);
            $cfile = new CURLFile($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name']);
            $data = array('image' => $cfile);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            $error = curl_error($ch);
            curl_close($ch);

            if ($error) {
                echo "<div class='error-message'>Error: " . $error . "</div>";
            } else {
                $response_data = json_decode($response, true);
                if (isset($response_data['mask_image']) && isset($response_data['diagnosis'])) {
                    $mask_image_data = $response_data['mask_image'];
                    $diagnosis = $response_data['diagnosis'];
                    $diagnosis_text = $diagnosis == 1 ? "Tumor Detected" : "No Tumor";

                    echo '<h2>Segmentation Mask:</h2>';
                    echo '<div class="results">';
                    echo '<img src="' . $mask_image_data . '" alt="Segmentation Mask" />';
                    echo '</div>';
                    echo "<h2>Diagnosis:</h2>";
                    echo "<p>" . htmlspecialchars($diagnosis_text) . "</p>";

                    $patient_id = $_POST['patient_id'];
                    $scan_date = $_POST['scan_date'];
                    $doctor_note = $_POST['note'];

                    $mri_image_path = "uploads/mri_{$patient_id}_" . date('YmdHis') . ".tif";
                    move_uploaded_file($_FILES['image']['tmp_name'], $mri_image_path);

                    $mask_image_path = "uploads/mask_{$patient_id}_" . date('YmdHis') . ".png"; 
                    file_put_contents($mask_image_path, base64_decode(str_replace('data:image/png;base64,', '', $mask_image_data)));

                    $stmt = $conn->prepare("INSERT INTO scans (patient_id, mri_image, mask_image, date, diagnosis, note) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("isssis", $patient_id, $mri_image_path, $mask_image_path, $scan_date, $diagnosis, $doctor_note);

                    if ($stmt->execute()) {
                        
                    } else {
                        echo "<div class='error-message'>Error saving data to the database.</div>";
                    }
                    
                    $stmt->close();
                } else {
                    echo "<div class='error-message'>Invalid response from Flask server.</div>";
                }
            }
        } else {
            echo "<div class='error-message'>No image uploaded.</div>";
        }
        ?>
    </div>
</body>
</html>
