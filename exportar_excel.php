<?php
require_once('conexao.php');

$colunasSelecionadas = isset($_GET['colunasSelecionadas']) ? $_GET['colunasSelecionadas'] : ['nome', 'email', 'telefone', 'data_nascimento', 'endereco', 'cidade', 'status'];

// Prepara a consulta
$colunasSQL = implode(", ", $colunasSelecionadas);
$sql = "SELECT $colunasSQL FROM usuarios";

$stmt = $bd->prepare($sql);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Cabeçalhos de exportação
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=lista_de_usuario.xls");
header("Cache-Control: no-cache, must-revalidate");

$dadosXls  = "<table border='1'>";
$dadosXls .= "<tr><td colspan='" . count($colunasSelecionadas) . "'><b>Lista de Usuários</b></td></tr>";
$dadosXls .= "<tr>";

// Cabeçalho das colunas
foreach ($colunasSelecionadas as $coluna) {
    $dadosXls .= "<th>" . ucfirst($coluna) . "</th>";
}
$dadosXls .= "</tr>";

// Linhas da tabela
foreach ($resultados as $linha) {
    $dadosXls .= "<tr>";
    foreach ($colunasSelecionadas as $coluna) {
        $dadosXls .= "<td>" . utf8_decode($linha[$coluna]) . "</td>";
    }
    $dadosXls .= "</tr>";
}

$dadosXls .= "</table>";
echo $dadosXls;
?>
