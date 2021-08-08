<?php

require "../banco_dados/conecta.php";

use Dompdf\Dompdf;
require_once '../dompdf/autoload.inc.php';




$tipo = $_POST['tipo'];
$codigo = $_POST['codigo'];
$produto = $_POST['produto'];
$setor = $_POST['setor'];
$inicio = $_POST['inicio'];
$fim = $_POST['fim'];

$tipo_text = $tipo == 'entrada' ? "entrada_produto" : "saida_produto";
$cod_text = $codigo == '' ? "1 = 1" : "codigo = '$codigo'";
$prod_text = $produto == '' ? "2 = 2" : "produto = '$produto'";
$setor_text = $setor == '' ? "3 = 3" : "setor = '$setor'";
$inicio_text = $inicio == '' ? "4 = 4" : "emissao >= '$inicio'";
$fim_text = $fim == '' ? "5 = 5" : "emissao <= '$fim'";


$sql = "SELECT * FROM $tipo_text, $tipo WHERE $cod_text and $prod_text and $setor_text and $inicio_text and $fim_text";

if($codigo != ''){
  $sql = "SELECT * FROM $tipo, $tipo_text WHERE $tipo.codigo = '$codigo'";
}
$resultado = mysqli_query($conn, $sql);
$total = 0;

$html = '<html>';
$html .= '<head>';
$html .= '<style>';
$html .= 'table {--bs-table-bg:transparent;
  --bs-table-accent-bg:transparent;
  --bs-table-striped-color:#212529;
  --bs-table-striped-bg:rgba(0, 0, 0, 0.05);
  --bs-table-active-color:#212529;
  --bs-table-active-bg:rgba(0, 0, 0, 0.1);
  --bs-table-hover-color:#212529;
  --bs-table-hover-bg:rgba(0, 0, 0, 0.075);
  width:100%;
  margin-bottom:1rem;
  color:#212529;
  vertical-align:top;
  border-color:#dee2e6;
  color: rgb(57, 33, 89);
  margin-top: 7%;
  padding-right: 5%;
  padding-left: 5%;
  text-align: center;
  margin-top: 50px;
  padding-right: 5%;
  padding-left: 5%;
  width:100%;
  padding-right:var(--bs-gutter-x,.75rem);
  padding-left:var(--bs-gutter-x,.75rem);
  margin-right:auto;
  margin-left:auto;
  color: rgb(57, 33, 89);}
  h3 {color: rgb(57, 33, 89);
    float: right;
    padding: 15px;
  }';
$html .= '</style>';

$html .= '</head>';
$html .= '<body>';

$html .= '<table>';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>Nota</th>';
$html .= '<th>Data</th>';
$html .= '<th>Produto</th>';
$html .= '<th>Preço</th>';
$html .= '<th>Quantidade</th>';
$html .= '<th>Total</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

while($row = mysqli_fetch_assoc($resultado)){
                
    $html .= '<tr>';
    $html .= '<td>'.$row['codigo'].'</td>';
    $html .= '<td>'.$row['emissao'].'</td>';
    $html .= '<td>'.$row['produto'].'</td>';
    $html .= '<td>'.$row['valor'].'</td>';
    $html .= '<td>'.$row['quantidade'].'</td>';
    $html .= '<td>'.($row['valor']*$row['quantidade']).'</td>';
    $html .= '</tr>';
    $total += ($row['valor']*$row['quantidade']);
}
$html .='</tbody>';
$html .='</table>';
$html .='<h3>Valor total:'.$total.'</h3>';
$html .='</body>';
$html .='</html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream();


echo $html;
?>

