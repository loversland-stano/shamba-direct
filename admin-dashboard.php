<?php require 'includes/header.php'; if(!isset($_SESSION['user'])||$_SESSION['user']['role']!='Administrator') die('Admin only');
$orders=$pdo->query("SELECT orders.*, users.name FROM orders JOIN users ON orders.buyer_id=users.id")->fetchAll();
if(isset($_GET['approve'])){ $pdo->prepare("UPDATE orders SET status='Confirmed' WHERE id=?")->execute([$_GET['approve']]); echo "Confirmed!"; }
echo "<h2>Admin Dashboard - Orders</h2>"; foreach($orders as $o) echo "<p>Order #".$o['id']." - ".$o['name']." - ".$o['status']." - KES ".$o['total']." <a href='?approve=".$o['id']."'>Confirm</a></p>";
require 'includes/footer.php'; ?>