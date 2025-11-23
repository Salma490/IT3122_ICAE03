<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable Reflected XSS Demo</title>
    <style>
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa; 
            color: #343a40;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 50px;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
            border: 1px solid #ced4da; 
            text-align: center;
        }

        h2 {
            color: #dc3545; 
            margin-bottom: 20px;
            border-bottom: 1px solid #dc3545;
            padding-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 12px; 
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-family: inherit;
        }

        input[type="submit"] {
            background-color: #dc3545; 
            color: white;
            padding: 12px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            font-size: 1rem;
        }

        input[type="submit"]:hover {
            background-color: #c82333;
        }

        .output {
            margin-top: 20px; 
            padding: 20px; 
            background-color: #fff3cd; 
            border: 1px solid #ffeeba;
            border-radius: 4px;
            color: #856404;
            font-size: 1.1em;
            font-weight: normal; 
            word-break: break-all;
            text-align: left; 
        }
        
        code {
            background-color: #e9ecef;
            padding: 3px 6px;
            border-radius: 3px;
            font-family: 'Courier New', Courier, monospace;
            color: #bd418c; 
        }
        p {
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reflected XSS: Vulnerable Output</h2>
        <p>Try submitting a payload like: <code>&lt;script&gt;alert('XSS')&lt;/script&gt;</code></p>
        
        <form method="GET">
            Name: <input type="text" name="name" placeholder="Enter text here">
            <input type="submit" value="Submit Name">
        </form>

        <?php
    
        if (isset($_GET['name'])) {
            $name = $_GET['name'];
            
            
            echo "<div class='output'>Hello " . $name . "</div>";
        }
        ?>
    </div>
</body>
</html>
