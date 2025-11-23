<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure CSRF Demo</title>
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
        }

        .transfer-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
            width: 350px;
            border: 1px solid #dee2e6; 
        }

        h2 {
            text-align: center;
            color: #007bff; 
            margin-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
        }

        p {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            margin-bottom: 25px;
            line-height: 1.4;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: 600;
            color: #495057;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px; 
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            text-align: left;
        }

        input[type="submit"] {
            background-color: #28a745;
            padding: 12px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .result-success, .result-failure {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
        }
        
        .result-success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
        
        .result-failure {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
        
        .token-display {
            font-size: 10px;
            color: #6c757d;
            word-break: break-all;
            margin-top: 20px; 
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="transfer-container">
        <?php
        session_start();
        $_SESSION['user'] = 'Alice';

        
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                echo "<div class='result-success'>Money Transferred! (Secure - Token Valid)</div>";
            } else {
                echo "<div class='result-failure'>CSRF Attack Detected! Invalid Token.</div>";
            }
        }
        ?>
        <h2>Secure Transfer Form</h2>
        <p>Current User: **<?php echo $_SESSION['user']; ?>**</p>
        <p>This form is protected by a CSRF token.</p>
        
        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            
            <label for="amount">Transfer Amount (USD):</label>
            <input type="text" id="amount" name="amount" value="1000" readonly>
            <input type="submit" value="Transfer Funds Securely">
        </form>
        
        <div class="token-display">
            **Current CSRF Token:** <?php echo $_SESSION['csrf_token']; ?>
        </div>
    </div>
</body>
</html>
