<?php
  include('./config/dbcon.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/index.css">
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
  <main class="container">
    <div class="title">
      <h1>Associados</h1>
      <p>Detalhes dos associados</p>
    </div>
    <div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Cpf</th>
            <th>Filiação</th>
            <th>Pago</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $conn = new Database();

            $query = "SELECT associate.*, associateAnnuity.paid 
            FROM associate 
            LEFT JOIN associateAnnuity ON associate.id = associateAnnuity.id_associate;";

            $runSQL = $conn->getConnection()->query($query);

            if(mysqli_num_rows($runSQL) > 0){
              foreach($runSQL as $associate){
                
                ?>
                <tr>
                  <td><?=$associate['id']; ?></td>
                  <td><?=$associate['name']; ?></td>
                  <td><?=$associate['email']; ?></td>
                  <td><?=$associate['cpf']; ?></td>
                  <td><?=$associate['membership_date']; ?></td>
                  <td><?=$associate['paid']; ?></td>
                </tr>
                <?php
              }
            } else {
              echo "<h3> Nenhum registro encontrado <h3>";
            }

          ?>

          
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
