<?php include 'inc/header.php'; ?>
<?php
// Input variables and Error handling variables
$title = $price = $image = $href = $desc = $tags = $quantity = '';
$titleErr = $priceErr = $imageErr = $descErr = $tagsErr = $quantityErr = '';

// Form submit
if(isset($_POST['submit'])) {
  // Validate title
  if(empty($_POST['title'])) {
    $titleErr = 'Title is required';
  } else {
    // Check if title is already in the database
    // Prepare SQL statement
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $titleCheck = "SELECT * FROM game WHERE title = '$title'";
    // Execute SQL statment
    $titleResult = mysqli_query($conn, $titleCheck);
    // Check if any rows returned
    if(mysqli_num_rows($titleResult) > 0) {
      $titleErr = 'Game already in database';
    } else {
      $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
  }

   // Validate price
   if(empty($_POST['price'])) {
    $priceErr = 'Price is required';
  } else {
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

   // Validate image
   $allowed_extension = array('png', 'jpg', 'jpeg');
   if(!empty($_FILES['upload']['name'])) {
    $file_name = $_FILES['upload']['name'];
    $file_size = $_FILES['upload']['size'];
    $file_tmp = $_FILES['upload']['tmp_name'];
    $target_dir = 'uploads/' . $file_name;

    // Get file extension
    $file_ext =  explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));

    // Validate file 
    if(in_array($file_ext, $allowed_extension)) {
      if($file_size <= 1000000) {
        move_uploaded_file($file_tmp, $target_dir);
        $href = "http://".$_SERVER['HTTP_HOST']."/".$target_dir;
      } else {
        $imageErr = 'File size too large';
      }
    } else {
      $imageErr = 'Invalid file type. Only PNG, JPG, and JPEG files are allowed.';
    }
   }

  //  Validate description
  if(empty($_POST['desc'])) {
    $descErr = 'Description is required';
  } else {
    $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  // Validate tag
  if(empty($_POST['tags'])) {
    $tagsErr = 'Tags are required';
  } else {
    $tags = filter_input(INPUT_POST, 'tags', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

   // Validate quantity
   if(empty($_POST['quantity'])) {
    $quantityErr = 'Quantity is required';
  } else {
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if(empty($titleErr) && empty($priceErr) && empty($imageErr) && empty($descErr) && empty($tagsErr) && empty($quantityErr)) {
    // Add to database
    $sql = "INSERT INTO game (title, price, upload, body, tags, quantity) VALUES ('$title', '$price', '$href', '$desc', '$tags', '$quantity')";

    if(mysqli_query($conn, $sql)) {
      // Success
      header('Location: view.php');
    } else {
      // Error
      echo 'Error: ' . mysqli_error($conn);
    }
  }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="mt-4 w-75" enctype="multipart/form-data">
  <!-- Title -->
  <div class="mb-3">
    <label for="game-title-input" class="form-label">Game Title</label>
    <input type="text" class="form-control <?php echo $titleErr ? 'is-invalid' : null; ?>" id="game-title-input" name="title" placeholder="Enter game title">
    <div class="invalid-feedback">
      <?php echo $titleErr; ?>
    </div>
  </div>
  <!-- Price -->
  <div class="mb-3">
    <label for="game-price-input" class="form-label">Game Price</label>
    <input type="text" class="form-control <?php echo $priceErr ? 'is-invalid' : null; ?>" id="game-price-input" name="price" placeholder="Enter game price">
    <div class="invalid-feedback">
      <?php echo $priceErr; ?>
    </div>
  </div>
  <!-- Image / Upload -->
  <div class="mb-3">
    <label for="game-cover-input" class="form-label">Game Cover</label>
    <input type="file" class="form-control <?php echo $imageErr ? 'is-invalid' : null; ?>" name="upload">
    <div class="invalid-feedback">
      <?php echo $imageErr; ?>
    </div>
  </div>
  <!-- Description -->
  <div class="mb-3">
    <label for="game-desc-input" class="form-label">Game Description</label>
    <input type="text" class="form-control <?php echo $descErr ? 'is-invalid' : null; ?>" name="desc" placeholder="Enter game description">
    <div class="invalid-feedback">
      <?php echo $descErr; ?>
    </div>
  </div>
  <!-- Tags -->
  <div class="mb-3">
    <label for="game-tag-input" class="form-label">Game tags</label>
    <input type="text" class="form-control <?php echo $tagsErr ? 'is-invalid' : null; ?>" name="tags" placeholder="Enter game tags">
    <div class="invalid-feedback">
      <?php echo $tagsErr; ?>
    </div>
  </div>
  <!-- Quantity -->
  <div class="mb-3">
    <label for="game-quantity-input" class="form-label">Quantity</label>
    <input type="text" class="form-control <?php echo $quantityErr ? 'is-invalid' : null; ?>" id="game-quantity-input" name="quantity" placeholder="Enter quantity">
    <div class="invalid-feedback">
      <?php echo $quantityErr; ?>
    </div>
  </div>
  
  <!-- Submit -->
  <div class="mb-3">
    <input type="submit" name="submit" value="Submit" class="btn btn-dark w-100">
  </div>
</form>
<?php include 'inc/footer.php'; ?>