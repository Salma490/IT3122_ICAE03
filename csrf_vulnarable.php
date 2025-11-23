<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable CSRF Demo</title>
    <style>
        /* Updated Styles for a cleaner, modern look */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa; /* Lighter, neutral background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            flex-direction: column;
            color: #343a40;
        }

        .transfer-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Softer, deeper shadow */
            width: 350px;
            border: 1px solid #dee2e6; /* Subtle border */
        }

        h2 {
            text-align: center;
            color: #dc3545; /* Retained red for warning */
            margin-bottom: 25px;
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
            padding: 12px; /* Slightly larger input */
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            text-align: left; /* Align text to the left */
            font-family: inherit;
        }

        input[type="submit"] {
            background-color: #dc3545; /* Red button for danger */
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
            background-color: #c82333;
        }

        .result-message {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="transfer-container">
        <?php
        session_start();
        // Simulating a logged in user
        $_SESSION['user'] = 'Alice'; 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "<div class='result-message'>Money Transferred! (Vulnerable - No Token Check)</div>";
        }
        ?>
        <h2>Vulnerable Transfer Form</h2>
        <p>Current User: <?php echo $_SESSION['user']; ?> </p>
        <p>If an attacker makes you submit this form automatically, the money goes without you knowing.</p>
        
        <form method="POST">
            <label for="amount">Transfer Amount (USD):</label>
            <input type="text" id="amount" name="amount" value="1000" readonly>
            <input type="submit" value="Transfer Funds Now">
        </form>
    </div>
</body>
</html>
