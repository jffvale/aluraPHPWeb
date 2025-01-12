<?php
require "src/conn.php";
require "src/model/Produto.php";
require "src/repository/ProdutoRepository.php";

$produtoRepository = new ProdutoRepository($pdo);
$produtoRepository->delete($_POST['id']); // Exclui o produto com o id passado por parâmetro na URL
header('Location: admin.php'); // Redireciona para a página admin.php após a exclusão do produto

// var_dump($_GET['id']); // Para verificar se o id está sendo passado corretamente

