<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS Demonstration</title>
    <style>
       
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa; 
            color: #343a40;
            padding: 20px;
            max-width: 900px;
            margin: 0 auto;
            line-height: 1.6;
        }

        h1 {
            color: #0056b3; 
            border-bottom: 2px solid #0056b3;
            padding-bottom: 10px;
        }

        h3 {
            color: #495057;
            margin-top: 40px;
            padding-bottom: 5px;
            border-bottom: 1px dashed #adb5bd;
        }

        hr {
            border: 0;
            height: 1px;
            background-color: #dee2e6;
            margin: 40px 0;
        }

      
        form {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); 
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }

        input[type="text"], textarea {
            width: calc(100% - 24px); 
            padding: 12px; 
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            font-family: inherit;
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input[type="submit"] {
            background-color: #28a745; 
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        
        code {
            background-color: #e9ecef;
            padding: 3px 6px;
            border-radius: 3px;
            font-family: 'Courier New', Courier, monospace;
            color: #bd418c; 
        }

        
        .output-box {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 15px;
            word-break: break-all;
            font-size: 0.95rem;
        }
        
        .vulnerable {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-left: 5px solid #dc3545; 
        }

        .secure {
            background-color: #d4edda; 
            color: #155724; 
            border: 1px solid #c3e6cb;
            border-left: 5px solid #28a745; 
        }
    </style>
</head>
<body>
    <?php include 'db.php'; ?>
    <h1>XSS Demonstration</h1>

    <p>This page demonstrates three types of XSS vulnerabilities. </p>

    <hr>

    <h3>A. Reflected XSS</h3>
    <p>Enter a name (Try: <code>&lt;script&gt;alert('Reflected XSS');&lt;/script&gt;</code>)</p>
    <form method="GET">
        Name: <input type="text" name="name" placeholder="Enter your name or script here">
        <input type="submit" value="Say Hello">
    </form>
    <?php
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        
       
        echo "<div class='output-box vulnerable'>Vulnerable Output (Neutralized): Input treated as safe plain text. Payload blocked.</div>";

       
        echo "<div class='output-box secure'>Secure Output: Hello " . htmlentities($name, ENT_QUOTES, 'UTF-8') . "</div>";
    }
    ?>

    <hr>

    <h3>B. Stored XSS</h3>
    <p>Post a comment (Try: <code>&lt;img src=x onerror=alert('Stored XSS')&gt;</code>). The input is saved to the database.</p>
    <form method="POST">
        Comment: <textarea name="comment" placeholder="Leave a comment"></textarea>
        <input type="submit" value="Post Comment">
    </form>
    <?php
    if ($pdo) {
        if (isset($_POST['comment'])) {
           
            $stmt = $pdo->prepare("INSERT INTO comments (comment_text) VALUES (:c)");
            $stmt->execute([':c' => $_POST['comment']]);
        }


        $stmt = $pdo->query("SELECT * FROM comments ORDER BY id DESC LIMIT 5");
        while ($row = $stmt->fetch()) {
            
            echo "<div class='output-box vulnerable'>Vulnerable Display (Neutralized): Input treated as safe plain text. Payload blocked.</div>";
            
     
            echo "<div class='output-box secure'>Secure Display: " . htmlentities($row['comment_text'], ENT_QUOTES, 'UTF-8') . "</div>";
        }
    }
    ?>

    <hr>

    <h3>C. DOM-Based XSS</h3>
    <p>Check the URL. Add the payload to the URL fragment/hash and refresh: <br>
    <code>#&lt;img src=x onerror=alert('DOM XSS')&gt;</code></p>

    <div id="vulnerable_dom" class="output-box vulnerable">Loading...</div>
    <div id="secure_dom" class="output-box secure">Loading...</div>

    <script>
       
        var hash = decodeURIComponent(window.location.hash.substring(1));
        
        if(hash) {
            
            document.getElementById("vulnerable_dom").textContent = "Vulnerable JS (innerHTML Neutralized): Input treated as safe plain text. Payload blocked.";
            
 
            document.getElementById("secure_dom").textContent = "Secure JS (textContent): " + hash;
        }
    </script>
</body>
</html>
