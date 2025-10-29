<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $note = $_POST['note'];
    $scan_id = $_POST['scan_id'];

    $stmt = $conn->prepare("UPDATE scans SET note = ? WHERE id = ? AND patient_id = ?");
    $stmt->bind_param("sii", $note, $scan_id, $patient_id);

    if ($stmt->execute()) {
        header("Location: patient_details.php?patient_id=$patient_id");
        exit();
    } else {
        echo "Error updating note: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>