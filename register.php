<?php require 'includes/header.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
  $name=trim($_POST['name']); $email=filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
  $role=in_array($_POST['role'],['Farmer','Buyer'])?$_POST['role']:'Buyer';
  $pass=$_POST['password'];
  if(!$email) $err="Invalid email";
  elseif(strlen($pass)<6) $err="Password too short - min 6 chars";
  else{
    $hash=password_hash($pass,PASSWORD_DEFAULT);
    $stmt=$pdo->prepare("INSERT INTO users(name,email,password,role,phone,location) VALUES(?,?,?,?,?,?)");
    try{$stmt->execute([$name,$email,$hash,$role,$_POST['phone']??'',$_POST['location']??'']);
    echo "<p style='color:green'>Registered! <a href='login.php'>Login now</a></p>";}catch(Exception $e){$err="Email already used";}
  }
  if(isset($err)) echo "<p style='color:red'>$err</p>";
}
?>
<h2>Register</h2><form method="POST">
<input name="name" placeholder="Full Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password (min 6)" required>
<select name="role"><option>Farmer</option><option>Buyer</option></select>
<input name="phone" placeholder="Phone"><input name="location" placeholder="Location">
<button>Register</button></form>
<?php require 'includes/footer.php'; ?>