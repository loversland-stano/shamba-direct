<?php require 'includes/header.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
  $stmt=$pdo->prepare("SELECT * FROM users WHERE email=?"); $stmt->execute([$_POST['email']]);
  $u=$stmt->fetch();
  if($u && password_verify($_POST['password'],$u['password'])){ $_SESSION['user']=$u;
    header("Location: ".($u['role']=='Administrator'?'admin-dashboard.php':($u['role']=='Farmer'?'farmer-dashboard.php':'catalogue.php'))); exit;
  } else echo "<p style='color:red'>Wrong email or password</p>";
}
?>
<h2>Login</h2><form method="POST"><input type="email" name="email" placeholder="Email" required><input type="password" name="password" placeholder="Password" required><button>Login</button></form>
<?php require 'includes/footer.php'; ?>