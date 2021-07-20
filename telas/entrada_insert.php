<?php

require "../banco_dados/conecta.php";



$codigo = $_POST['codigo'];
$origem = $_POST['origem'];
$destino = $_POST['destino'];
$emissao = $_POST['emissao'];
$recebimento = $_POST['recebimento'];
$dados = $_POST['dados'];


$dados_array = json_decode($dados,true);


foreach($dados_array as $valor){
  $produto = $valor["Produto"];
  $quantidade = $valor["Quantidade"];
  $valor = $valor["Valor unidade"];
  $sql = "INSERT INTO entrada_produto (codigo, produto, quantidade, valor)
  VALUES ('$codigo','$produto','$quantidade','$valor')";
  mysqli_query($conn, $sql);
}

$sql = "INSERT INTO entrada (codigo, origem, destino, emissao, recebimento)
VALUES ('$codigo','$origem','$destino','$emissao', '$recebimento')";
if (mysqli_query($conn, $sql)) {
  header('location:entrada.php');
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>