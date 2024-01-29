<?php 
  if(isset($_SESSION['message'])) :
?>

    <div>
      <p><?= $_SESSION['message']; ?></p>
    </div>

<?php 
  unset($_SESSION['message']);
  endif;
?>