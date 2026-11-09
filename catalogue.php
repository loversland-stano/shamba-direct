<?php require 'includes/header.php';
$search='%'.($_GET['q']??'').'%';
$stmt=$pdo->prepare("SELECT produce.*, users.name as farmer FROM produce JOIN users ON produce.farmer_id=users.id WHERE produce.name LIKE ?");
$stmt->execute([$search]); $rows=$stmt->fetchAll();
?>
<h2>Produce Catalogue</h2>
<form><input name="q" placeholder="Search tomatoes..." value="<?=esc($_GET['q']??'')?>"><button>Search</button></form>
<div class="grid"><?php foreach($rows as $r): ?>
<div class="card"><h3><?=esc($r['name'])?></h3><p>KES <?=esc($r['price'])?> | <?=esc($r['quantity'])?> in stock</p><p>Farmer: <?=esc($r['farmer'])?> - <?=esc($r['location'])?></p>
<a class="btn" href="product.php?id=<?=$r['id']?>">View</a>
<a class="btn" href="cart.php?add=<?=$r['id']?>">Add to Cart</a></div><?php endforeach; ?>
<?php if(count($rows)==0) echo "<p>No produce found. Register as Farmer to add some.</p>"; ?></div>
<?php require 'includes/footer.php'; ?>