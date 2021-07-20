<?php

require "../banco_dados/conecta.php";



$codigo = $_POST['codigo'];
$natureza = $_POST['natureza'];
$destino = $_POST['destino'];
$cnpj = $_POST['cnpj'];
$emissao = $_POST['emissao'];
$dados = $_POST['dados'];


$dados_array = json_decode($dados,true);


foreach($dados_array as $valor){
  $produto = $valor["Produto"];
  $quantidade = $valor["Quantidade"];
  $valor = $valor["Valor unidade"];
  $sql = "INSERT INTO saida_produto (codigo, produto, quantidade, valor)
  VALUES ('$codigo','$produto','$quantidade','$valor')";
  mysqli_query($conn, $sql);
}

$sql = "INSERT INTO saida (codigo, natureza, destino, cnpj, emissao)
VALUES ('$codigo','$natureza','$destino','$cnpj', '$emissao')";
if (mysqli_query($conn, $sql)) {
  header('location:saida.php');
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>