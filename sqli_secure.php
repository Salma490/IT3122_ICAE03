<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Login Demo</title>
    <style>
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            flex-direction: column;
            color: #343a40;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
            border: 1px solid #dee2e6; 
        }

        h2 {
            text-align: center;
            color: #007bff; 
            margin-bottom: 25px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
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
            padding: 12px; 
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            font-family: inherit;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; 
        }

        h3 {
            text-align: center;
            margin-top: 20px;
            padding: 15px; 
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
        }

        .success {
            color: #155724; 
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
        
        .failure {
            color: #721c24; 
            background-color: #f8d7da; 
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <?php include 'db.php'; ?>
        <h2>Secure Login </h2>
        <form method="POST">
            Username: <input type="text" name="username" placeholder="Enter username"><br>
            Password: <input type="password" name="password" placeholder="Enter password"><br>
            <input type="submit" value="Login">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $u = $_POST['username'];
            $p = $_POST['password'];


            $sql = "SELECT * FROM users WHERE username = :u AND password = :p";
            
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':u', $u);
            $stmt->bindParam(':p', $p);
            $stmt->execute();

            if ($stmt->fetch()) {
                echo "<h3 class='success'>Logged in successfully! (Secure)</h3>";
            } else {
                echo "<h3 class='failure'>Login failed.</h3>";
            }
        }
        ?>
    </div>
</body>
</html>
