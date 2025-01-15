<?php
require "src/conn.php";
require "src/model/Produto.php";
require "src/repository/ProdutoRepository.php";

$produtoRepository = new ProdutoRepository($pdo);
$produtos = $produtoRepository->buscarTodos();
?>

<style>
.container-table{
    display: flex;
    align-items: center;
    flex-direction: column;
}

table{
    width: 90%;
    margin: auto 0;
}
table, th, td{
    border: 1px solid #EBC181;
}

table th{
    padding: 11px 0 11px;
    background-color: #EBC181;
    color: #333B1E;
    font-weight: bold;
    font-size: 18px;
    text-align: left;
    padding: 8px;
}

table tr{
    border: 1px solid #ddd;
}

table td{
    color: #333B1E;
    font-size: 18px;
    padding: 8px;
}
.container-admin-banner h1{
    margin-top: 40px;
    font-size: 30px;
    color: #EBC181;
}
</style>

<table>
    <thead>
        <tr>
            <th>Produto</th>
            <th>Tipo</th>
            <th>Descricão</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto) : ?>
            <tr>
                <td><?= $produto->getNome(); ?></td>
                <td><?= $produto->getTipo(); ?></td>
                <td><?= $produto->getDescricao(); ?></td>
                <td>R$ <?= $produto->getPrecoFormatado(); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>