<?php require 'includes/header.php'; if(!isset($_SESSION['user'])||$_SESSION['user']['role']!='Farmer') die('Farmers only');
$fid=$_SESSION['user']['id'];
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add'])){
  $s=$pdo->prepare("INSERT INTO produce(farmer_id,category_id,name,price,quantity,location) VALUES(?,?,?,?,?,?)");
  $s->execute([$fid,$_POST['cat'],$_POST['name'],$_POST['price'],$_POST['qty'],$_POST['location']]); echo "<p style='color:green'>Added!</p>";
}
if(isset($_GET['del'])){ $s=$pdo->prepare("DELETE FROM produce WHERE id=? AND farmer_id=?"); $s->execute([$_GET['del'],$fid]); echo "<p>Deleted</p>"; }
$rows=$pdo->query("SELECT * FROM produce WHERE farmer_id=$fid")->fetchAll();
?>
<h2>My Produce - Welcome <?=esc($_SESSION['user']['name'])?></h2>
<form method="POST"><input name="name" placeholder="Produce Name e.g. Tomatoes" required>
<input name="price" type="number" step="0.01" placeholder="Price KES" required>
<input name="qty" type="number" placeholder="Quantity" required>
<input name="location" placeholder="Location e.g. Kiambu">
<select name="cat"><option value="1">Vegetables</option><option value="2">Fruits</option><option value="3">Grains</option><option value="4">Dairy</option><option value="5">Poultry</option></select>
<button name="add">Add Produce</button></form>
<h3>My Listings</h3>
<?php foreach($rows as $r) echo "<p>".esc($r['name'])." - KES ".$r['price']." - Qty ".$r['quantity']." <a href='?del=".$r['id']."'>Delete</a></p>"; ?>
<?php require 'includes/footer.php'; ?>