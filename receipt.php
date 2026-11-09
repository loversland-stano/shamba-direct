<?php require 'includes/header.php';
$s=$pdo->prepare("SELECT orders.*, users.name FROM orders JOIN users ON orders.buyer_id=users.id WHERE orders.id=?"); $s->execute([$_GET['id']]); $o=$s->fetch();
$items=$pdo->prepare("SELECT order_items.*, produce.name FROM order_items JOIN produce ON order_items.produce_id=produce.id WHERE order_id=?"); $items->execute([$_GET['id']]);
?>
<h2>Receipt - Order #<?=esc($o['id'])?></h2><p>Buyer: <?=esc($o['name'])?></p><p>Status: <?=esc($o['status'])?></p><p>Total: KES <?=esc($o['total'])?></p>
<?php foreach($items as $it) echo "<p>".esc($it['name'])." x ".$it['qty']." = KES ".($it['price']*$it['qty'])."</p>"; ?>
<button onclick="window.print()">Print / Save as PDF</button>
<?php require 'includes/footer.php'; ?>