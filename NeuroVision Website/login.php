<?php
session_start(); 

require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username'], $_POST['password'], $_POST['role'])) {
        $email = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);

        if ($role === 'doctor') {
            $sql = "SELECT * FROM doctor WHERE name = '$email' AND id = '$password'";
        } elseif ($role === 'patient') {
            $sql = "SELECT * FROM patient WHERE name = '$email' AND id = '$password'";
        } else {
            $_SESSION['error_message'] = "Invalid role selected.";
            header("Location: index.php");
            exit();
        } 

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo "Login successful! Welcome, " . ucfirst($role) . ".";

            if ($role === 'doctor') {
                header("Location: doctor_dashboard.php");
            } elseif ($role === 'patient') {
                $_SESSION['patient_id'] = $user['id'];
                $_SESSION['patient_name'] = $user['name']; 
                header("Location: patient_dashboard.php");
            }
            exit();
        } else {
            // Login failed
            $_SESSION['error_message'] = "Wrong username or password";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Please fill in all fields.";
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

$conn->close();
?>
