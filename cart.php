<?php require 'includes/header.php';
if(!isset($_SESSION['cart'])) $_SESSION['cart']=[];
if(isset($_GET['add'])){ $id=(int)$_GET['add']; $_SESSION['cart'][$id]=($_SESSION['cart'][$id]??0)+1; echo "<p>Added to cart</p>"; }
if(isset($_GET['remove'])){ unset($_SESSION['cart'][(int)$_GET['remove']]); }
$total=0; echo "<h2>Cart</h2>";
foreach($_SESSION['cart'] as $id=>$qty){
  $s=$pdo->prepare("SELECT * FROM produce WHERE id=?"); $s->execute([$id]); $p=$s->fetch(); if(!$p) continue;
  $sub=$p['price']*$qty; $total+=$sub;
  echo "<p>".esc($p['name'])." - KES ".$p['price']." x $qty = KES $sub <a href='?remove=$id'>Remove</a></p>";
}
echo "<h3>Total: KES $total</h3><a class='btn' href='checkout.php'>Checkout</a> <a href='catalogue.php'>Continue Shopping</a>";
require 'includes/footer.php'; ?>