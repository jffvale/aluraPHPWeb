<?php
class Produto {
    private ?int $id;   // O ?int é para indicar que o atributo pode ser nulo
    private string $tipo;
    private string $nome;
    private string $descricao;
    private float $preco;
    private string $imagem;

    // Construtor para inicializar os atributos da classe em PHP
    // O ?int é para indicar que o atributo pode ser nulo e a imagem padrão é o logo-serenatto.png
    public function __construct(?int $id, string $tipo, string $nome, string $descricao, float $preco, string $imagem = "logo-serenatto.png") {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->imagem = $imagem;
    }

    // Getter e Setter para $id
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    // Getter e Setter para $tipo
    public function getTipo(): string {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void {
        $this->tipo = $tipo;
    }

    // Getter e Setter para $nome
    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    // Getter e Setter para $descricao
    public function getDescricao(): string {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void {
        $this->descricao = $descricao;
    }

    // Getter e Setter para $imagem
    public function getImagem(): string {
        return $this->imagem;
    }

    public function setImagem(string $imagem): void {
        $this->imagem = $imagem;
    }

    public function getImagemFolder(): string {
        return "img/" . $this->imagem;
    }

    // Getter e Setter para $preco
    public function getPreco(): float {
        return $this->preco;
    }

    public function setPreco(float $preco): void {
        $this->preco = $preco;
    }

    // Método para formatar o preço
    public function getPrecoFormatado(): string {
        return number_format($this->preco, 2);
    }

}   // Fim da classe Produto