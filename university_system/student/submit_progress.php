<?php
include_once("../includes/db_connection.php");
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] != "student") {
    header("Location: ../login.php");
    exit();
}

// Initialize error message variable
$error_message = "";
$success_message = "";

// Handle form submission to submit progress
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST['project_id'];
    $project_link = $_POST['project_link'];
    
    // Retrieve student ID from session
    $student_id = $_SESSION['user_id']; // Assuming 'user_id' is the column name for student ID in your users table
    
    // Fetch group ID for the selected student
    $group_query = "SELECT group_id FROM student_group WHERE student_id = '$student_id'";
    $group_result = $conn->query($group_query);
    
    if ($group_result->num_rows > 0) {
        $row = $group_result->fetch_assoc();
        $group_id = $row['group_id'];
        
        // Check if project ID already exists for the group
        $existing_project_query = "SELECT * FROM project_links WHERE project_id = '$project_id' AND group_id = '$group_id'";
        $existing_project_result = $conn->query($existing_project_query);
        
        if ($existing_project_result->num_rows > 0) {
            $error_message = "Project ID already exists for this group.";
        } else {
            // Insert the project link into database
            $sql = "INSERT INTO project_links (project_id, group_id, link, submission_date) VALUES ('$project_id', '$group_id', '$project_link', NOW())";
            if ($conn->query($sql) === TRUE) {
                $success_message = "Project link submitted successfully";
            } else {
                $error_message = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        $error_message = "Error: Group ID not found for student and project combination";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Project Link</title>
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
        .submit-project-link-container {
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
        input {
            padding: 10px;
            width: 100%;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: #1976d2;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #1565c0;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #1976d2;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .back-btn:hover {
            background-color: #1565c0;
        }
        .success-message {
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }
        .error-message {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="submit-project-link-container">
        <h2>Submit Project Link</h2>
        <?php
        if (isset($success_message)) {
            echo '<p class="success-message">' . $success_message . '</p>';
        }
        if (!empty($error_message)) {
            echo '<p class="error-message">' . $error_message . '</p>';
        }
        ?>
        <form action="" method="post">
            <label for="project_id">Project ID:</label>
            <input type="text" name="project_id" required> <!-- Assuming this is an integer input -->
            <label for="project_link">Project Link:</label>
            <input type="text" name="project_link" required>
            <button type="submit">Submit</button>
        </form>
        <a href="student_dashboard.php" class="back-btn">Back to Dashboard</a>
    </div>
</body>
</html>
