<?php

require "../banco_dados/conecta.php";

$setor = $_POST['setor'];
$responsavel = $_POST['responsavel'];
$tipo = $_POST['tipo'];
$cnpj = $_POST['cnpj'];

$sql = "INSERT INTO setor (setor, responsavel, tipo, cnpj)
VALUES ('$setor','$responsavel','$tipo', '$cnpj')";

if (mysqli_query($conn, $sql)) {
  header('location:setor.php');
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>