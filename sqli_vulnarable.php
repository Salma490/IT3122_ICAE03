<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable Login Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form > * {
            margin-bottom: 15px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; 
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        h3 {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
        }

        .success {
            color: white;
            background-color: #dc3545; 
        }
        
        .failure {
            color: #6c757d;
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <?php include 'db.php'; ?>
        <h2>Vulnerable Login (SQL Injection)</h2>
        <form method="POST">
            Username: <input type="text" name="username" placeholder="Enter username"><br>
            Password: <input type="password" name="password" placeholder="Enter password"><br>
            <input type="submit" value="Login">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $u = $_POST['username'];
            $p = $_POST['password'];
            

            $sql = "SELECT * FROM users WHERE username = '$u' AND password = '$p'";

            
            $stmt = $pdo->query($sql);
            
            if ($stmt->fetch()) {
                echo "<h3 class='success'>Logged in successfully! (Vulnerable)</h3>";
            } else {
                echo "<h3 class='failure'>Login failed.</h3>";
            }
        }
        ?>
    </div>
</body>
</html>