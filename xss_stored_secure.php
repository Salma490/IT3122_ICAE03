<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Stored XSS Demo (Connected)</title>
    <style>

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f8f9fa; 
            color: #343a40; 
            padding: 20px;
            max-width: 700px;
            margin: 0 auto;
        }
        h2 {
            color: #007bff; 
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        form {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
            margin-bottom: 30px;
            border: 1px solid #dee2e6; 
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600; 
        }
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            resize: vertical;
            min-height: 90px; 
            box-sizing: border-box;
            font-family: inherit; 
        }
        input[type="submit"] {
            background-color: #28a745; 
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            font-size: 1rem; 
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .comment-display {
            border: 1px solid #c3e6cb;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 4px;
            background-color: #d4edda;
            color: #155724;
            word-wrap: break-word;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); 
        }
        .comment-text {
            font-weight: normal;
            display: block;
            margin-top: 5px;
            line-height: 1.4;
        }
        code {
            background-color: #e9ecef;
            padding: 3px 6px;
            border-radius: 3px;
            font-family: 'Courier New', Courier, monospace; 
            color: #bd418c; 
        }
        p {
            line-height: 1.5; 
        }
    </style>
</head>
<body>
    <?php
    
    include 'db.php'; 
    ?>

    <h2>Secure Stored XSS Demonstration</h2>
    <p>This section is **protected**. User input is saved as raw text, but is safely **encoded on output** using <code>htmlentities()</code>, preventing script execution.</p>
    <p>Try posting the payload: <code>&lt;img src=x onerror=alert('Stored XSS')&gt;</code></p>

    <form method="POST">
        <label for="comment">Leave a Comment:</label>
        <textarea name="comment" id="comment" placeholder="Your comment..."></textarea>
        <input type="submit" value="Post Comment Securely">
    </form>
    
    <h3>Recent Comments (Secure Output)</h3>

    <?php
    if ($pdo) {
        
        if (isset($_POST['comment'])) {
            $stmt = $pdo->prepare("INSERT INTO comments (comment_text) VALUES (:c)");
            $stmt->execute([':c' => $_POST['comment']]);
        }

      
        try {
            $stmt = $pdo->query("SELECT * FROM comments ORDER BY id DESC LIMIT 5");
            while ($row = $stmt->fetch()) {
                
                $safe_comment = htmlentities($row['comment_text'], ENT_QUOTES, 'UTF-8');
                echo "<div class='comment-display'>
                        Comment #{$row['id']}: 
                        <span class='comment-text'>" . $safe_comment . "</span>
                      </div>";
            }
        } catch (\PDOException $e) {
             echo "<div class='comment-display' style='background-color:#fff3cd; color:#856404; border-color:#ffeeba;'>
                   <strong>SQL Query Error:</strong> " . htmlspecialchars($e->getMessage()) . 
                   "</div>";
        }
    }
    ?>
</body>
</html>
