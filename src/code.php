<?php
session_start();
require_once 'config/dbcon.php';

if(isset($_POST['create_associate'])) {
  $conn = new Database();

  $name = $_POST['name'];
  $email = $_POST['email'];
  $cpf = $_POST['cpf'];
  $membership_date = $_POST['membership'];

  $sql = "INSERT INTO associate (name, email, cpf, membership_date) VALUES ('$name', '$email', '$cpf', '$membership_date')";

  $runSQL = $conn->getConnection()->query($sql);

  if($runSQL){
    $_SESSION['message'] = "Associado criado com sucesso";
    header("Location: associate-create.php");
    exit(0);
  } else {
    $_SESSION['message'] = "Não foi possivel criar um Associado";
    header("Location: associate-create.php");
    exit(0);
  }

  echo $_SESSION['message'];
}

if(isset($_POST['create_annuity'])) {
  $conn = new Database();

  $year = $_POST['year'];
  $value = $_POST['value'];


  $sql = "INSERT INTO annuitity (year, value) VALUES ('$year', '$value')";

  $runSQL = $conn->getConnection()->query($sql);

  if($runSQL){
    $_SESSION['message'] = "Anuidade criado com sucesso";
    header("Location: annuitity-create.php");
    exit(0);
  } else {
    $_SESSION['message'] = "Não foi possivel criar uma Anuidade";
    header("Location: annuitity-create.php");
    exit(0);
  }

  echo $_SESSION['message'];
}

