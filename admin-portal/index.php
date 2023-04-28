<?php include 'inc/header.php'; ?>
<?php
session_start();
if(isset($_POST['submit'])) {
  $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
  $password = $_POST['password'];
  if ($username == 'ubgames' && $password == 'ubgames!') {
    $_SESSION['username'] = $username;
    header('Location: input.php');
  } else {
    echo 'Incorrect Login';
  }
}
?>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
  <div>
    <label for="username">Username: </label>
    <input type="text" name="username">
  </div>
  <div>
    <label for="password">Password: </label>
    <input type="password" name="password">
  </div>
  <input type="submit" value="Submit" name="submit">
</form>
<?php include 'inc/footer.php'; ?>