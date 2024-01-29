<?php
include('./config/dbcon.php');

$conn = new Database();

$queryAssociates = "SELECT id, name, membership_date FROM associate";
$resultAssociates = $conn->getConnection()->query($queryAssociates);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/chekout.css">
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
        <div class="title">
            <h1>Chekout</h1>
            <p>Valores devidos</p>
        </div>

        <?php include('message.php'); ?>
        <div>
            <?php if ($resultAssociates && mysqli_num_rows($resultAssociates) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Data de Filiação</th>
                            <th>Anuidades Devidas (Ano - Valor)</th>
                            <th>Valor Total Devido</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultAssociates as $associate): ?>
                            <tr>
                                <td><?= $associate['id']; ?></td>
                                <td><?= $associate['name']; ?></td>
                                <td><?= $associate['membership_date']; ?></td>
                                <?php
                                $dueAnnuitiesResult = getDueAnnuities($associate['id']);
                                if ($dueAnnuitiesResult['count'] > 0) {
                                    ?>
                                    <td><?= implode(', ', $dueAnnuitiesResult['dueAnnuities']); ?></td>
                                    <td><?= 'R$ ' . number_format($dueAnnuitiesResult['totalDue'], 2, ',', '.'); ?></td>
                                    <?php
                                } else {
                                    ?>
                                    <td>Nenhuma</td>
                                    <td>R$ 0,00</td>
                                    <?php
                                }
                                ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Nenhum associado encontrado.</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>

<?php

function getDueAnnuities($id_associate)
{
    global $conn;

    $queryMembershipDate = "SELECT membership_date FROM associate WHERE id = $id_associate";
    
    $result = $conn->getConnection()->query($queryMembershipDate);

    if ($result->num_rows > 0) {
        $rowMembershipDate = $result->fetch_assoc();
        $membershipDate = strtotime($rowMembershipDate['membership_date']);

        $queryAnnuities = "SELECT year, value FROM annuitity";
        $resultAnnuities = $conn->getConnection()->query($queryAnnuities);

        $dueAnnuities = [];
        $totalDue = 0;

        if ($resultAnnuities->num_rows > 0) {
            foreach ($resultAnnuities as $rowAnnuity) {
                $annuityYear = strtotime($rowAnnuity['year'] . '-01-01');

                if ($annuityYear >= $membershipDate) {
                    $dueAnnuities[] = $rowAnnuity['year'] . ' (' . 'R$ ' . number_format($rowAnnuity['value'], 2, ',', '.') . ')';
                    $totalDue += $rowAnnuity['value'];
                }
            }
        }

        return [
            'dueAnnuities' => $dueAnnuities,
            'totalDue' => $totalDue,
            'count' => count($dueAnnuities),
        ];
    }

    return [
        'dueAnnuities' => [],
        'totalDue' => 0,
        'count' => 0,
    ];
}


?>
