<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Student Management System</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .landing-container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            max-width: 400px;
            width: 90%;
        }

        h1,h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #007bff; /* Material UI primary color */
        }

        p {
            font-size: 1.1rem;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .btn-login {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            text-decoration: none;
            color: #fff;
            background-color: #007bff; /* Material UI primary color */
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #0056b3; /* Darker shade for hover effect */
        }
    </style>
</head>
<body>
    <div class="landing-container">
        <h2>Welcome to Project Management System for Jain (Deemed-to-be University)</h2>
        <p>This system helps in managing student projects, marks, attendance, and more.</p>
        <p>Please login to continue.</p>
        <a href="login.php" class="btn-login">Login</a>
    </div>

    <script>
        // Disable browser back button to prevent navigation back to this page
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
</body>
</html>
