<?php include 'doctor_nav.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Registry</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #b4e4f9, #d3d9db);
        }

        h1 {
            margin-bottom: 20px;
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

        .table tbody tr {
            transition: background-color 0.3s; 
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .btn-primary {
            background-color: #0463fa; 
            border-color: #0463fa; 
            transition: background-color 0.3s, transform 0.3s; 
        }

        .btn-primary:hover {
            background-color: #034fc8;
            transform: scale(1.05);
        }

        .btn-detail {
            background-color: #0db5f0;
            border-color: #17a2b8; 
            color: white;
            transition: background-color 0.3s, transform 0.3s; 
        }

        .btn-detail:hover {
            background-color: #17a2b8;
            color: white;
            transform: scale(1.05); 
        }

        .modal-header {
            background-color: #0463fa; 
            color: white; 
        }

        .modal-content {
            border-radius: 8px;
        }

        .modal-body {
            padding: 20px; 
        }

        .form-control {
            border-radius: 5px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Patient Registry</h1> 
        
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPatientModal">Add Patient</button>

        <div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPatientModalLabel" style="color: whitesmoke;">Add Patient</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addPatientForm" action="add_patient.php" method="post">
                            <div class="mb-3">
                                <label for="patientID" class="form-label">Patient ID</label>
                                <input type="text" class="form-control" id="patientID" name="id" required>
                            </div>
                            <div class="mb-3">
                                <label for="patientName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="patientName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="patientPhone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="patientPhone" name="phone_number" required>
                            </div>
                            <div class="mb-3">
                                <label for="patientAge" class="form-label">Age</label>
                                <input type="number" class="form-control" id="patientAge" name="age" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Patient</button>
                        </form>
                        <div id="error-message" class="error-message mt-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="mt-4">Registered Patients</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="patientsTableBody">
                <?php
                require 'db_connect.php'; 

                $sql = "SELECT * FROM patient";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['phone_number']}</td>
                            <td>{$row['age']}</td>
                            <td><a href='patient_details.php?patient_id={$row['id']}' class='btn btn-detail btn-sm'>Patient Details</a></td>

                            
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No patients found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
