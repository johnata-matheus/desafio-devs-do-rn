<?php
  session_start();
  include('./config/dbcon.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Management</title>
  <link rel="stylesheet" href="assets/css/associate/create.css">
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/annuitity.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
  <header class="header-bg">
    
    <div class="header container">
        <a href="index.php">Management</a>

      <nav>
        <ul class="header-menu">
          <li><a href="./index.php">Home</a></li>
          <li><a href="./associate-create.php">Criar Associado</a></li>
          <li><a href="./annuitity-create.php">Criar Anuidade </a></li>
          <li><a href="./chekout.php">Chekout</a></li>
        </ul>
      </nav>
    </div>
      
  </header>
  <div class="container">
    <div div class="title">
      <h1>Criar Anuidade</h1>
      <p>Preencha os campos a seguir</p>
    </div>

    <?php include('message.php'); ?>

    <div>
      <form action="code.php" method="POST">
        <div>
          <label for="year">Ano<label>
          <input type="number" name="year" id="year" required>
        </div>
        <div>
          <label for="value">valor</label>
          <input type="number" name="value" id="value" required>
        </div>
        <div>
          <button class="btn-primary" type="submit" name="create_annuity">Criar</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>