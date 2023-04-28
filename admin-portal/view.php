<?php include 'inc/header.php'; ?>
<?php
$sql = 'SELECT * FROM game';
$result = mysqli_query($conn, $sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!-- Add padding here -->
  <h2>Game Database</h2>
<?php if (empty($feedback)): ?>
    <p class="lead mt3">There is no feedback</p>

<?php endif; ?>

<?php foreach($feedback as $item): ?>
  <div class="card my-3 w-75">
    <div class="card-body text-center">
      <?php echo $item['title']; ?>
      </div>
    </div>
  <?php endforeach; ?>


<?php include 'inc/footer.php'; ?>