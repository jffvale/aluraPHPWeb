<?php

class ProdutoRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    private function formarObjeto($dados): Produto{
        return new Produto(
            $dados['id'],
            $dados['tipo'],
            $dados['nome'],
            $dados['descricao'],
            $dados['preco'],
            $dados['imagem']
        );
    }

    public function opcoesCafe(): array{
        $sqliCafe = "SELECT * FROM produtos WHERE tipo = 'cafe' ORDER BY preco"; // Query para selecionar todos os produtos do tipo café
        $statement = $this->pdo->query($sqliCafe); // $pdo é a conexão com o banco de dados e está dentro de classe, logo precisamos usar o this->pdo
        $produtosCafe = $statement->fetchAll(mode: PDO::FETCH_ASSOC);   // Retorna um array associativo

        // Transformando o array associativo $produtosCafe em um array de objetos da classe Produto ($dadosCafe)
        $dadosCafe = array_map(function ($cafe) {   // Função array_map() aplica uma função em todos os elementos de um array
            return $this->formarObjeto($cafe);  // Retorna um objeto da classe Produto
        }, $produtosCafe);  // $produtosCafe é o array associativo com os produtos do tipo café

        // Testes para verificar a conexão com o banco de dados e o conteúdo das variáveis
        // var_dump($dadosCafe);    // Array de Objetos - Para testar a conexão e ver conteúdo (no terminal, C:\xampp\htdocs\aluraPhp\src> php index.php).
        // var_dump($produtosCafe);    // Array de Arrays - usamos o var_dump() para ver o conteúdo da variável $produtosCafe.
        // exit(); // Para parar a execução do código e ver o resultado no terminal.

        return $dadosCafe;  // Retorna um array de objetos da classe Produto
    }   // Fim da classe ProdutoRepository

    public function opcoesAlmoco(): array{
        $sqliAlmoco = "SELECT * FROM produtos WHERE tipo = 'almoco' ORDER BY preco"; // Query para selecionar todos os produtos do tipo almoço
        $statement = $this->pdo->query($sqliAlmoco); // $pdo é a conexão com o banco de dados e está dentro de classe, logo precisamos usar o this->pdo
        $produtosAlmoco = $statement->fetchAll(mode: PDO::FETCH_ASSOC);   // Retorna um array associativo

        // Transformando o array associativo $produtosAlmoco em um array de objetos da classe Produto ($dadosAlmoco)
        $dadosAlmoco = array_map(function ($almoco) {   // Função array_map() aplica uma função em todos os elementos de um array
            return $this->formarObjeto($almoco);  // Retorna um objeto da classe Produto
        }, $produtosAlmoco);  // $produtosAlmoco é o array associativo com os produtos do tipo almoço

        // Testes para verificar a conexão com o banco de dados e o conteúdo das variáveis
        // var_dump($dadosAlmoco);    // Array de Objetos - Para testar a conexão e ver conteúdo (no terminal, C:\xampp\htdocs\aluraPhp\src> php index.php).
        // var_dump($produtosAlmoco);    // Array de Arrays - usamos o var_dump() para ver o conteúdo da variável $produtosAlmoco.
        // exit(); // Para parar a execução do código e ver o resultado no terminal.

        return $dadosAlmoco;  // Retorna um array de objetos da classe Produto
    }   // Fim da classe ProdutoRepository

    // Buscar todos os produtos
    public function buscarTodos(): array{
        $sqli = "SELECT * FROM produtos ORDER BY preco"; // Query para selecionar todos os produtos
        $statement = $this->pdo->query($sqli);
        $todosProdutos = $statement->fetchAll(mode: PDO::FETCH_ASSOC);

        // Transformando o array associativo $produtos em um array de objetos da classe Produto ($dados)
        $dadosTodosProdutos = array_map(function ($produto) {   // Função array_map() aplica uma função em todos os elementos de um array
            return $this->formarObjeto($produto);  // Retorna um objeto da classe Produto
        }, $todosProdutos);  // $produtos é o array associativo com os produtos

        // Testes para verificar a conexão com o banco de dados e o conteúdo das variáveis
        // var_dump($dadosTodosProdutos);    // Array de Objetos - Para testar a conexão e ver conteúdo (no terminal, C:\xampp\htdocs\aluraPhp\src> php index.php).
        // var_dump($todosProdutos);    // Array de Arrays - usamos o var_dump() para ver o conteúdo da variável $produtos.
        // exit(); // Para parar a execução do código e ver o resultado no terminal.

        return $dadosTodosProdutos;  // Retorna um array de objetos da classe Produto
    }   // Fim da classe ProdutoRepository

    public function create(Produto $produto): void{
        $sqli = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem) VALUES (:tipo, :nome, :descricao, :preco, :imagem)";

        $statement = $this->pdo->prepare($sqli);    // Prepara a query para ser executada
        $statement->bindValue(':tipo', $produto->getTipo());    // Substitui os valores da query
        $statement->bindValue(':nome', $produto->getNome());
        $statement->bindValue(':descricao', $produto->getDescricao());
        $statement->bindValue(':preco', $produto->getPreco());
        $statement->bindValue(':imagem', $produto->getImagem());
        $statement->execute();
    }

    public function read(int $id): Produto{
        $sqli = "SELECT * FROM produtos WHERE id = ?"; // usando o ? para evitar SQL Injection, Uses positional parameters (?), equivalente.
        $statement = $this->pdo->prepare($sqli);
        $statement->bindValue(1, $id);
        $statement->execute();
        $produtoById = $statement->fetch(mode: PDO::FETCH_ASSOC);   // Recupera a linha da tabela como um array associativo
        return $this->formarObjeto($produtoById);   // Retorna um objeto da classe Produto usando a função formarObjeto(), acima.
    }

    public function update(Produto $produto): void{
        $sqli = "UPDATE produtos SET tipo = :tipo, nome = :nome, descricao = :descricao, preco = :preco, imagem = :imagem WHERE id = :id";
        $statement = $this->pdo->prepare($sqli);
        $statement->bindValue(':tipo', $produto->getTipo());
        $statement->bindValue(':nome', $produto->getNome());
        $statement->bindValue(':descricao', $produto->getDescricao());
        $statement->bindValue(':preco', $produto->getPreco());
        $statement->bindValue(':imagem', $produto->getImagem());
        $statement->bindValue(':id', $produto->getId());
        $statement->execute();
    }

    public function delete(int $id): void{
        $sqli = "DELETE FROM produtos WHERE id = :id";  // usando o :id para evitar SQL Injection, Uses named parameters (:name), equivalente.
        $statement = $this->pdo->prepare($sqli);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }
}
