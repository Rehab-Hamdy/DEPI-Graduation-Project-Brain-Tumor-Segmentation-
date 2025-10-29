<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['question'];
    $data = json_encode(array("question" => $question));

    $ch = curl_init('http://127.0.0.1:5000/answer');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        $answer = "Error: Could not connect to the chatbot server. " . curl_error($ch);
    } else {
        $response = json_decode($result, true);
        $answer = $response["answer"] ?? "No answer available.";
    }

    curl_close($ch);
}
?>

<?php include 'patient_nav.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medical Chatbot</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #b4e4f9, #d3d9db);
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #2980b9;
            padding: 10px 20px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            margin-bottom: 50px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            display: inline-block;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-top: 70px; 
        }

        form {
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 85%;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%; 
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box; 
        }

        input[type="submit"] {
            background-color: #2980b9;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #3498db;
        }

        .answer-box {
            margin: 30px auto;
            background-color: #ecf0f1;
            padding: 15px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            max-width: 85%;
        }

        h2.answer-title {
            color: #e74c3c;
        }

        p {
            font-size: 16px;
        }

    </style>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h2>Brain Tumor Medical Chatbot</h2>
    <form method="post">
        <label for="question">Ask a medical question:</label>
        <input type="text" id="question" name="question" required>
        <input type="submit" value="Get Answer">
    </form>

    <?php if (!empty($answer)): ?>
        <div class="answer-box">
            <h2 class="answer-title">Answer:</h2>
            <p><?php echo htmlspecialchars($answer); ?></p>
        </div>
    <?php endif; ?>
</body>
</html>
