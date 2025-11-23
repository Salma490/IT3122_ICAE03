<?php
$host = 'localhost'; 
$db   = 'csica3';       
$user = 'root';     
$pass = '';  
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
  
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];


ini_set('display_errors', 1);
error_reporting(E_ALL);


$pdo = null;
try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     

     $pdo->exec("CREATE TABLE IF NOT EXISTS comments (
         id INT AUTO_INCREMENT PRIMARY KEY,
         comment_text TEXT NOT NULL,
         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     )");

} catch (\PDOException $e) {

     $error_message = htmlspecialchars($e->getMessage());
     echo "<div style='background-color: #f8d7da; color: #721c24; padding: 15px; border: 1px solid #f5c6cb; margin: 15px 0;'>
           <strong>DATABASE CONNECTION FAILED:</strong> Check your <code>db.php</code> settings.
           <br><strong>Error Details:</strong> {$error_message}
           </div>";
     $pdo = null; 
}
?>