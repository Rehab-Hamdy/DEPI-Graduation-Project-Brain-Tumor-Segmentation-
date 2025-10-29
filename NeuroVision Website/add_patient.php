<?php
session_start(); 
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $conn->real_escape_string($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    $age = $conn->real_escape_string($_POST['age']);

    $checkSql = "SELECT * FROM patient WHERE id = '$id'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        $_SESSION['error_message'] = "Patient with this ID already exists.";
        header("Location: patients.php");
        exit();
    }

    $sql = "INSERT INTO patient (id, name, phone_number, age) VALUES ('$id', '$name', '$phone_number', '$age')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Patient added successfully.";
    } else {
        $_SESSION['error_message'] = "Error: " . $conn->error;
    }

    header("Location: patient_registry.php");
    exit();
}

$conn->close();
?>
