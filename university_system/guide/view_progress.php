<?php
include_once("../includes/db_connection.php");
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] != "guide") {
    header("Location: ../login.php");
    exit();
}

// Handle form submission to view project links
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $group_id = $_POST['group_id'];

    // Retrieve project links for the given group ID
    $project_links_sql = "SELECT * FROM project_links WHERE group_id = '$group_id'";
    $project_links_result = $conn->query($project_links_sql);

    if ($project_links_result === false) {
        echo "Error: " . $project_links_sql . "<br>" . $conn->error;
    }
}

// Retrieve all group IDs and their details
$groups_query = "SELECT group_id FROM student_group";
$groups_result = $conn->query($groups_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project Links</title>
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
        .view-project-links-container {
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
        select[name="group_id"] {
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
        .project-links-list {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        .project-links-list h3 {
            color: #1976d2;
        }
        .project-links-list ul {
            list-style-type: none;
            padding: 0;
            margin-top: 10px;
        }
        .project-links-list li {
            margin-bottom: 10px;
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
    <div class="view-project-links-container">
        <h2>View Project Links</h2>
        <form action="" method="post">
            <label for="group_id">Select Group:</label>
            <select name="group_id" required>
                <?php
                if ($groups_result->num_rows > 0) {
                    while ($group_row = $groups_result->fetch_assoc()) {
                        echo "<option value='" . $group_row['group_id'] . "'>" . $group_row['group_id'] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No groups found</option>";
                }
                ?>
            </select>
            <button type="submit">View Links</button>
        </form>
        
        <?php if(isset($project_links_result)): ?>
        <div class="project-links-list">
            <h3>Project Links for Group <?php echo $group_id; ?></h3>
            <ul>
                <?php
                if ($project_links_result->num_rows > 0) {
                    while($row = $project_links_result->fetch_assoc()) {
                        echo "<li><a href='".$row["link"]."' target='_blank'>".$row["link"]."</a> (Submission Date: ".$row["submission_date"].")</li>";
                    }
                } else {
                    echo "<li>No project links found for this group</li>";
                }
                ?>
            </ul>
        </div>
        <?php endif; ?>
        
        <a href="guide_dashboard.php" class="back-btn">Back to Guide Dashboard</a>
    </div>
</body>
</html>
