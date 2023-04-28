<!-- Include database -->
<?php include 'config\database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Portal</title>
  <!-- Stylesheet -->
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/navigation-bar.css">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <!-- Header -->
   <!--Nav bar-->
   <nav class="navbar">
    <div class="brand-title">UB Games</div>
    <a href="#" class="toggle-button">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </a>
    <div class="navbar-links">
      <ul>
        <li><a href="input.php">Input</a></li>
        <li><a href="view.php">View Database</a></li>
      </ul>
    </div>
  </nav>
  <!-- Form -->
  <main >
    <div class="container d-flex flex-column align-items-center">