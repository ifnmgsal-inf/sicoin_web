<?php

require "../banco_dados/conecta.php";



$codigo = $_POST['codigo'];
$natureza = $_POST['natureza'];
$destino = $_POST['destino'];
$cnpj = $_POST['cnpj'];
$emissao = $_POST['emissao'];
$dados = $_POST['dados'];
$valida = true;

$dados_array = json_decode($dados,true);


foreach($dados_array as $valor){
  $produto = $valor["Produto"];
  $quantidade = $valor["Quantidade"];
  $valor = $valor["Valor unidade"];

  mysqli_commit($conn);
  
  $sql = "SELECT * FROM produto WHERE descricao = '$produto'";
  $resultado = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($resultado)){
    if(($row['estoque'] - $quantidade) < 0){
      $valida = false;
    }
  }

  $sql = "INSERT INTO saida_produto (codigo, produto, quantidade, valor)
  VALUES ('$codigo','$produto','$quantidade','$valor')";
  mysqli_query($conn, $sql);
}

$sql = "INSERT INTO saida (codigo, natureza, destino, cnpj, emissao)
VALUES ('$codigo','$natureza','$destino','$cnpj', '$emissao')";
if($valida){
  mysqli_autocommit($conn, true);
} else{
  mysqli_rollback($conn);
}

if (mysqli_query($conn, $sql)) {
  header('location:saida.php');
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>