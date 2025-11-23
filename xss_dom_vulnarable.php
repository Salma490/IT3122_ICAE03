<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable XSS Demo</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            padding: 30px;
            max-width: 650px;
            margin: auto;
            line-height: 1.6;
        }

        h2 {
            color: #d9534f;
            border-bottom: 3px solid #d9534f;
            padding-bottom: 8px;
        }

        code {
            background-color: #fff3cd;
            padding: 4px 7px;
            border-radius: 4px;
            color: #856404;
        }

        #output {
            background-color: #fff3cd;
            padding: 15px;
            border-left: 8px solid #f0ad4e;
            margin-top: 20px;
            font-size: 1.15em;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h2>Vulnerable PHP XSS Demonstration</h2>

<p>This page is <strong>vulnerable</strong> because it directly outputs a GET parameter using
<code>echo</code> without sanitizing.</p>

<p>Test using a malicious payload:</p>
<p><code>?input=&lt;img src=x onerror=alert('XSS')&gt;</code></p>

<?php

$input = isset($_GET['input']) ? $_GET['input'] : "Waiting for input...";


echo "<div id='output'>Output (Vulnerable): $input</div>";
?>

</body>
</html>
