<?php
// Copy to config.php and fill real details. NEVER put real password here.
$host = "localhost";
$dbname = "agribusiness";
$username = "root";
$password = "";
try {
 $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch(PDOException $e) { die("Connection failed: " . $e->getMessage()); }
function esc($str){ return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); }
?>