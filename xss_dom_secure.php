<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure XSS</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #eef4ff; 
            color: #1a1a1a;
            padding: 30px;
            max-width: 700px;
            margin: auto;
            line-height: 1.6;
        }

        h2 {
            color: #1e6fd9; 
            border-bottom: 3px solid #1e6fd9;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        p {
            font-size: 1.05rem;
        }

        code {
            background-color: #dce6ff;
            padding: 4px 7px;
            border-radius: 4px;
            font-family: monospace;
            color: #003399;
        }

      
        #secure_output {
            background-color: #d4e8ff;
            color: #003366;
            padding: 18px;
            border-left: 8px solid #1e6fd9;
            border-radius: 6px;
            border: 1px solid #bcd6f7;
            margin-top: 20px;
            font-weight: 600;
            font-size: 1.15rem;
            word-wrap: break-word;
            box-shadow: 0 0 8px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>

<h2>Secure PHP-Based XSS Demonstration</h2>

<p>This PHP page prevents XSS by escaping user input using 
<code>htmlspecialchars()</code>.</p>

<p>Test by adding a malicious payload: <br>
<code>?input=&lt;img src=x onerror=alert('XSS')&gt;</code></p>

<?php

$input = $_GET['input'] ?? "Waiting for input...";


$clean = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

echo "<div id='secure_output'>Output (Secure): $clean</div>";
?>

</body>
</html>
