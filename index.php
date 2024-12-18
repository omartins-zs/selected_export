<?php
require_once('conexao.php');

// Variáveis de pesquisa
$nomePesquisa = "";
$telefonePesquisa = "";

// Recupera os parâmetros de pesquisa
if (isset($_GET['nome'])) {
    $nomePesquisa = addslashes($_GET['nome']);
}
if (isset($_GET['telefone'])) {
    $telefonePesquisa = addslashes($_GET['telefone']);
}

// Filtros de pesquisa
$pesquisaCondicao = "";
if (!empty($nomePesquisa)) {
    $pesquisaCondicao .= " AND nome LIKE '%$nomePesquisa%'";
}
if (!empty($telefonePesquisa)) {
    $pesquisaCondicao .= " AND telefone LIKE '%$telefonePesquisa%'";
}

// Colunas padrão para exibição e exportação
$colunasSelecionadas = ['nome', 'email', 'telefone', 'data_nascimento', 'endereco', 'cidade', 'status'];
$colunasSQL = implode(", ", $colunasSelecionadas);
$sql = "SELECT $colunasSQL FROM usuarios WHERE 1=1 $pesquisaCondicao";

$stmt = $bd->prepare($sql);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Lista de Usuários</h2>

        <!-- Formulário de Pesquisa -->
        <form action="exportar.php" method="get" class="form-inline mb-4">
            <div class="form-group mr-2">
                <label for="nome" class="mr-2">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= $nomePesquisa ?>">
            </div>
            <div class="form-group mr-2">
                <label for="telefone" class="mr-2">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?= $telefonePesquisa ?>">
            </div>
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </form>

        <!-- Tabela de Usuários -->
        <table class="table">
            <thead>
                <tr>
                    <?php foreach ($colunasSelecionadas as $coluna): ?>
                        <th><?= ucfirst($coluna) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $linha): ?>
                    <tr>
                        <?php foreach ($colunasSelecionadas as $coluna): ?>
                            <td><?= utf8_decode($linha[$coluna]) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Formulário de Exportação -->
        <form action="exportar_excel.php" method="get">
            <div class="form-group">
                <label for="colunasSelecionadas">Escolha as Colunas para Exportação</label>
                <select id="colunasSelecionadas" name="colunasSelecionadas[]" multiple class="form-control mb-3" size="7">
                    <option value="nome" selected>Nome</option>
                    <option value="email" selected>Email</option>
                    <option value="telefone" selected>Telefone</option>
                    <option value="data_nascimento" selected>Data de Nascimento</option>
                    <option value="endereco" selected>Endereço</option>
                    <option value="cidade" selected>Cidade</option>
                    <option value="status" selected>Status</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Exportar para Excel</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
