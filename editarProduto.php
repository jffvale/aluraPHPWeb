<?php
require "src/conn.php";
require "src/model/Produto.php";
require "src/repository/ProdutoRepository.php";

$produtoRepository = new ProdutoRepository($pdo);
// Busca o produto com o id passado por parâmetro na URL

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $produto = $produtoRepository->read($id);

  // echo "Dados do formulário via GET\n" . "<br>";
  // var_dump($produto);
  // exit();

  // Cria um novo objeto Produto com os dados do formulário
  if (isset($_POST['editar'])) {

    $produto = new Produto(
      $_POST['id'],
      $_POST['tipo'],
      $_POST['nome'],
      $_POST['descricao'],
      $_POST['preco']
    );

    if (!empty($_FILES['imagem']['name'])) {
      // unique id para garantir que o nome do arquivo seja único
      $produto->setImagem(uniqid() . $_FILES['imagem']['name']); // posição 'name' do array FILES contém o nome do arquivo
      move_uploaded_file($_FILES['imagem']['tmp_name'], $produto->getImagemFolder()); // move o arquivo para a pasta img/produtos

      // var_dump($_FILES['imagem']);
      // exit();
    }

    // echo "Dados do formulário via POST\n" . "<br>";
    // var_dump($produto);
    // exit();

    $produtoRepository->update($produto);
    header('Location: admin.php');
  }
}

?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/form.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Serenatto - Editar Produto</title>
</head>

<body>
  <main>
    <section class="container-admin-banner">
      <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
      <h1>Editar Produto</h1>
      <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
    </section>
    <section class="container-form">
      <form action="#" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $produto->getId() ?>">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" value="<?= $produto->getNome() ?>" required>

        <div class="container-radio">
          <div>
            <label for="cafe">Café</label>
            <input type="radio" id="cafe" name="tipo" value="Café" <?= $produto->getTipo() === 'Café' ? 'checked' : '' ?>>
          </div>
          <div>
            <label for="almoco">Almoço</label>
            <input type="radio" id="almoco" name="tipo" value="Almoço" <?= $produto->getTipo() === 'Almoço' ? 'checked' : '' ?>>
          </div>
        </div>

        <label for="descricao">Descrição</label>
        <input type="text" id="descricao" name="descricao" placeholder="Digite uma descrição" value="<?= $produto->getDescricao() ?>" required>

        <label for="preco">Preço</label>
        <input type="text" id="preco" name="preco" placeholder="Digite o preço do produto" value="<?= $produto->getPrecoFormatado() ?>" required>

        <label for="imagem">Envie uma imagem do produto / Imagem atual:<br>"<?= $produto->getImagem() ?>"</label>
        <input type="file" name="imagem" accept="image/*" id="imagem" placeholder="Envie uma imagem">

        <input type="submit" name="editar" class="botao-cadastrar" value="Editar produto" />
      </form>

    </section>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="js/index.js"></script>
</body>

</html>