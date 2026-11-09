<?php require 'includes/header.php';
if(!isset($_SESSION['user'])){ header("Location: login.php"); exit; }
if(empty($_SESSION['cart'])) die("Cart empty. <a href='catalogue.php'>Go to Catalogue</a>");
$total=0; foreach($_SESSION['cart'] as $id=>$qty){ $s=$pdo->prepare("SELECT * FROM produce WHERE id=?"); $s->execute([$id]); $p=$s->fetch(); $total+=$p['price']*$qty; }
$s=$pdo->prepare("INSERT INTO orders(buyer_id,total) VALUES(?,?)"); $s->execute([$_SESSION['user']['id'],$total]); $oid=$pdo->lastInsertId();
foreach($_SESSION['cart'] as $id=>$qty){ $s=$pdo->prepare("SELECT * FROM produce WHERE id=?"); $s->execute([$id]); $p=$s->fetch(); $pdo->prepare("INSERT INTO order_items(order_id,produce_id,qty,price) VALUES(?,?,?,?)")->execute([$oid,$id,$qty,$p['price']]); }
$_SESSION['cart']=[];
echo "<h2>Order Placed!</h2><p>Order #$oid - Total KES $total - Status: Placed</p><a class='btn' href='receipt.php?id=$oid'>View Receipt / Print</a>";
require 'includes/footer.php'; ?>