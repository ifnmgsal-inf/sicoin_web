<?php

require "../banco_dados/conecta.php";

$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$tipo = $_POST['tipo'];

$sql = "INSERT INTO usuario (nome, endereco, telefone, tipo, usuario, senha)
VALUES ('$nome','$endereco','$telefone', '$tipo', '$usuario', '$senha' )";

if (mysqli_query($conn, $sql)) {
  header('location:usuario.php');
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>