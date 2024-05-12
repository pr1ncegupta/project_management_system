<?php
include_once("../includes/db_connection.php");
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] != "guide") {
    header("Location: ../login.php");
    exit();
}

// Fetch guide ID based on the logged-in guide's username
$guide_username = $_SESSION['username'];
$guide_id_query = "SELECT user_id FROM users WHERE username = '$guide_username'";
$result = $conn->query($guide_id_query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $guide_id = $row['user_id'];

    // Retrieve all students with their IDs
    $students_query = "SELECT user_id, username FROM users WHERE user_type = 'student'";
    $students_result = $conn->query($students_query);

    // Handle form submission to enter remarks
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $student_id = $_POST['student_id'];
        $remark = $_POST['remark'];
        
        // Insert the remark into database
        $sql = "INSERT INTO remarks (student_id, guide_id, remark, date) VALUES ('$student_id', '$guide_id', '$remark', NOW())";
        
        if ($conn->query($sql) === TRUE) {
            $success_message = "New record inserted successfully";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    $error_message = "Error: Guide ID not found";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Remarks</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .enter-remarks-container {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
        }
        h2 {
            color: #1976d2;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            margin-bottom: 10px;
        }
        select[name="student_id"] {
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            appearance: none;
            -webkit-appearance: none;
            background-image: linear-gradient(to bottom, #ffffff 50%, #e0e0e0 100%);
            background-repeat: no-repeat;
            background-position: right 10px center;
        }
        textarea[name="remark"] {
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #1976d2;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #1565c0;
        }
        .success-message {
            color: #4caf50;
            margin-top: 10px;
        }
        .error-message {
            color: #f44336;
            margin-top: 10px;
        }
        .back-btn {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #757575;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .back-btn:hover {
            background-color: #424242;
        }
    </style>
</head>
<body>
    <div class="enter-remarks-container">
        <h2>Enter Remarks</h2>
        <form action="" method="post">
            <label for="student_id">Select Student:</label>
            <select name="student_id" required>
                <?php
                if ($students_result->num_rows > 0) {
                    while ($student_row = $students_result->fetch_assoc()) {
                        echo "<option value='" . $student_row['user_id'] . "'>" . $student_row['username'] . " (ID: " . $student_row['user_id'] . ")</option>";
                    }
                } else {
                    echo "<option value='' disabled>No students found</option>";
                }
                ?>
            </select>
            <label for="remark">Remark:</label>
            <textarea name="remark" rows="4" required></textarea>
            <button type="submit">Submit</button>
        </form>
        
        <?php
        if (isset($success_message)) {
            echo "<p class='success-message'>$success_message</p>";
        }
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
        
        <a href="guide_dashboard.php" class="back-btn">Back to Guide Dashboard</a>
    </div>
</body>
</html>
