<?php

require "../banco_dados/conecta.php";

$descricao = $_POST['descricao'];
$estoque = $_POST['estoque'];
$unidade = $_POST['unidade'];

$sql = "INSERT INTO produto (descricao, estoque, unidade)
VALUES ('$descricao','$estoque','$unidade')";

if (mysqli_query($conn, $sql)) {
  header('location:produto.php');
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>