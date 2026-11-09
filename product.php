<?php require 'includes/header.php';
$stmt=$pdo->prepare("SELECT produce.*, users.name as farmer FROM produce JOIN users ON produce.farmer_id=users.id WHERE produce.id=?");
$stmt->execute([$_GET['id']??0]); $r=$stmt->fetch(); if(!$r) die('Not found');
?>
<h2><?=esc($r['name'])?></h2><p>Price: KES <?=esc($r['price'])?></p><p>Quantity: <?=esc($r['quantity'])?></p><p>Farmer: <?=esc($r['farmer'])?> - <?=esc($r['location'])?></p>
<a class="btn" href="cart.php?add=<?=$r['id']?>">Add to Cart</a> <a href="catalogue.php">Back</a>
<?php require 'includes/footer.php'; ?>